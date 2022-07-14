import React from "react";
import BotsTable from "../Controls/BotsTable/BotsTable";
import SettingsContext from "../Settings";
import BotSettingsModal from "../Controls/Modals/BotSettingsModal";
import CommandsList from "../Controls/Commands/CommandsList";
import $ from "jquery";
import { isNullOrUndefined } from "util";
import BotInfoModal from "../Controls/Modals/BotInfoModal";
import BankLogModal from "../Controls/Modals/BankLogModal";
import BotSortModal from "../Controls/Modals/BotSortModal";
//import { try_eval } from "../serviceF";
import LogsModal from "../Controls/Modals/LogsModal";
import BankLogsModal from "../Controls/Modals/BankLogsModal";
import OnOffCheckbox from "../Controls/Modals/OnOffCheckbox";
// import BotCounts from "./BotCounts";

class BotsList extends React.Component {
  constructor(props) {
    super(props);
    this.BotListForceUpdate = this.BotListForceUpdate.bind(this);
    this.state = {
      botOnline: SettingsContext.BotsFilterMode[0],
      botOffline: SettingsContext.BotsFilterMode[1],
      botDead: SettingsContext.BotsFilterMode[2],
      botHaveExistBanks: SettingsContext.BotsFilterMode[3],
      botHaveNotExistBanks: SettingsContext.BotsFilterMode[4],
      botTriggerStatBanks: SettingsContext.BotsFilterMode[5],
      botTriggerStatCC: SettingsContext.BotsFilterMode[6],
      botTriggerStatMail: SettingsContext.BotsFilterMode[7],
      botFilterCountry: SettingsContext.BotsFilterMode[8],
      botFilterID: SettingsContext.BotsFilterMode[9],
      botByCountry: SettingsContext.BotByCountry,
      botByApp: SettingsContext.BotByApp,
      botByOperator: SettingsContext.BotByOperator,
      botsPerPage: SettingsContext.BotsPerPage,
      FindBotById: SettingsContext.FindBotByID,
      botsPerPageCustom: !["10", "25", "50", "100"].includes(SettingsContext.BotsPerPage),
    };
  }

  BotListForceUpdate() {
    this.forceUpdate();
  }

  deleteSelectedBots() {
    // TODO: Callback to refresh table after fetch
    let botsList = "";
    SettingsContext.SelectedBots.forEach(function (element) {
      botsList += element + ",";
    }); // преобразование в нужный формат массива ботов

    let request = $.ajax({
      type: "POST",
      url: SettingsContext.restApiUrl,
      data: {
        params: new Buffer(
          '{"request":"deleteBots","idbot":"' +
            botsList.substring(0, botsList.length - 1) +
            '"}'
        ).toString("base64"),
      },
    });

    request.done(
      function (msg) {
        try {
          let result = JSON.parse(msg);
          if (!isNullOrUndefined(result.error)) {
            SettingsContext.ShowToastTitle("error", "ERROR", result.error);
          } else {
            SettingsContext.ShowToast("success", result.message);
            SettingsContext.CurrentSetBot = "";
            SettingsContext.UpdateTable();
            this.forceUpdate();
          }
        } catch (ErrMgs) {
          SettingsContext.ShowToastTitle(
            "error",
            "ERROR",
            "Error deleteBots command. Look console for more details."
          );
          console.log("Error - " + ErrMgs);
        }
      }.bind(this)
    );
  }

  /* FilterModal() {
    try_eval('$("#BotSortTableModal").modal("show");');
  } */

  /* SelectAllBots() {
    SettingsContext.SelectedBots = SettingsContext.BotsOnPage;
    this.forceUpdate();
  }

  clearSelection() {
    SettingsContext.SelectedBots = [];
    this.forceUpdate();
  } */

  callbackBtn(Value, BtnParam) {
    let update = {};
    if (BtnParam === "botOnline") {
      update = {
        botOnline: Value,
      };
    } else if (BtnParam === "botOffline") {
      update = {
        botOffline: Value,
      };
    } else if (BtnParam === "botDead") {
      update = {
        botDead: Value,
      };
    } else if (BtnParam === "botHaveExistBanks") {
      update = {
        botHaveExistBanks: Value,
      };
    } else if (BtnParam === "botHaveNotExistBanks") {
      update = {
        botHaveNotExistBanks: Value,
      };
    } else if (BtnParam === "botTriggerStatBanks") {
      update = {
        botTriggerStatBanks: Value,
      };
    } else if (BtnParam === "botTriggerStatCC") {
      update = {
        botTriggerStatCC: Value,
      };
    } else if (BtnParam === "botTriggerStatMail") {
      update = {
        botTriggerStatMail: Value,
      };
    } else if (BtnParam === "botFilterCountry") {
      update = {
        botFilterCountry: Value,
        botByCountry: Number(Value) === 1 ? this.state.botByCountry : "",
      };
    }
    this.setState({ ...update }, () => this.SaveSettings());
  }

  onChangeConutry = (e) => {
    if (e.target.value.length < 4)
      this.setState(
        {
          botByCountry:
            Number(this.state.botFilterCountry) === 1 ? e.target.value : "",
        },);
  };
  handleChange = (e) => {
    const { name, value } = e.target;
    this.setState({
      [name]: value
    })
  }
  onChangeBotID = (e) => {
    this.setState(
      {
        FindBotById: Number(this.state.botFilterID) === 1 ? e.target.value : "",
      });
  };

  SaveSettings() {
    if (this.state.botByCountry === "") {
      // this.state.botFilterCountry = 0;
    }
    SettingsContext.BotsFilterMode =
      this.state.botOnline +
      this.state.botOffline +
      this.state.botDead +
      this.state.botHaveExistBanks +
      this.state.botHaveNotExistBanks +
      this.state.botTriggerStatBanks +
      this.state.botTriggerStatCC +
      this.state.botTriggerStatMail +
      this.state.botFilterCountry +
      this.state.botFilterID;
    SettingsContext.BotsPerPage = this.state.botsPerPage;
    SettingsContext.BotByCountry = this.state.botByCountry;
    SettingsContext.BotByApp = this.state.botByApp;
    SettingsContext.BotByOperator = this.state.botByOperator;
    SettingsContext.FindBotByID = this.state.FindBotById;
    this.ChangeSettings();
  }

  ClearSettings() {
    this.setState({
      FindBotById: "",
      botByCountry: "",
      botDead: "0",
      botFilterCountry: "1",
      botFilterID: "1",
      botHaveExistBanks: "0",
      botHaveNotExistBanks: "0",
      botOffline: "0",
      botOnline: "1",
      botTriggerStatBanks: "0",
      botTriggerStatCC: "0",
      botTriggerStatMail: "0",
      botsPerPage: "25",
      botsPerPageCustom: false,
    }, () => this.SaveSettings())
  }

  checkOnlyNumbers(val) {
    return parseInt(val) ? true : false;
  }

  onChangeBotsPerPage = (e) => {
    if (!e.target.value) {
      return
    } else if (this.checkOnlyNumbers(e.target.value)) {
      this.setState(
        {
          botsPerPage: parseInt(e.target.value),
        },
        () => this.SaveSettings()
      );
    } else if (e.target.value === "custom") {
      this.setState({ botsPerPageCustom: true });
    }
  };

  OnFocusChange = (e) => {
    if (e.target.value === "") {
      this.setState({
        botsPerPage: SettingsContext.BotsPerPage,
        FindBotById: SettingsContext.FindBotByID,
      });
    }
  };

  ChangeSettings() {
    this.forceUpdate();
    SettingsContext.SaveSettingsCookies();
  }

  render() {
    return (
      <div>
        <div className="filter-body">
          <div className="filter-search row justify-content-center">
            <div className="col-md-8 col-12">
              <div className="row flex-wrap align-items-center">
                <div className="col-12 col-md-1 p-3 text-right">
                  <i class="fas fa-sync pointer" onClick={this.ClearSettings.bind(this)}></i>
                </div>
                <div className="col-12 col-md-11">
                  <div className="row flex-wrap">
                    <div className="filter-search-item col-md-3 col-12 p-3">
                      <input
                        className="form-control"
                        value={this.state.FindBotById}
                        onChange={this.onChangeBotID}
                        onBlur={this.SaveSettings.bind(this)}
                        placeholder="ID"
                      />
                    </div>
                    <div className="filter-search-item col-md-3 col-12 p-3">
                      <input
                        className="form-control"
                        value={this.state.botByCountry}
                        onChange={this.onChangeConutry}
                        onBlur={this.SaveSettings.bind(this)}
                        placeholder="Country Code"
                      />
                    </div>
                    <div className="filter-search-item col-md-3 col-12 p-3">
                      <input
                        className="form-control"
                        placeholder="App"
                        name="botByApp"
                        value={this.state.botByApp}
			onChange={this.handleChange}
                        onBlur={this.SaveSettings.bind(this)}
                      />
                    </div>
                    <div className="filter-search-item col-md-3 col-12 p-3">
                      <input
                        className="form-control"
                        placeholder="Operator"
                        name="botByOperator"
                        value={this.state.botByOperator}
			onChange={this.handleChange}
                        onBlur={this.SaveSettings.bind(this)}
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div className="filter-check row flex-wrap my-4">
                <div className="filter-check-item col-md-2 col-6 p-2">
                  <OnOffCheckbox
                    callback={this.callbackBtn.bind(this)}
                    name={"botOnline"}
                    label="Online"
                    status={this.state.botOnline}
                  />
                </div>
                <div className="filter-check-item col-md-2 col-6 p-2">
                  <OnOffCheckbox
                    callback={this.callbackBtn.bind(this)}
                    name={"botOffline"}
                    label="Offline"
                    status={this.state.botOffline}
                  />
                </div>
                <div className="filter-check-item col-md-2 col-6 p-2">
                  <OnOffCheckbox
                    callback={this.callbackBtn.bind(this)}
                    name={"botDead"}
                    label="Dead"
                    status={this.state.botDead}
                  />
                </div>
                <div className="filter-check-item col-md-2 col-6 p-2">
                  <OnOffCheckbox
                    callback={this.callbackBtn.bind(this)}
                    name={"botHaveExistBanks"}
                    label="Has injects"
                    status={this.state.botHaveExistBanks}
                  />
                </div>
                <div className="filter-check-item col-md-2 col-6 p-2">
                  <OnOffCheckbox
                    callback={this.callbackBtn.bind(this)}
                    name={"botHaveNotExistBanks"}
                    label="Has not injects"
                    status={this.state.botHaveNotExistBanks}
                  />
                </div>
                <div className="filter-check-item col-md-2 col-6 p-2">
                  <OnOffCheckbox
                    callback={this.callbackBtn.bind(this)}
                    name={"botTriggerStatBanks"}
                    label="Triggered inject"
                    status={this.state.botTriggerStatBanks}
                  />
                </div>
                {/* <div className="filter-check-item col-md-2 col-6 p-2">
                  <OnOffCheckbox name={""} label="Has phone number" />
                </div>
                <div className="filter-check-item col-md-2 col-6 p-2">
                  <OnOffCheckbox name={""} label="Has banks" />
                </div>
                <div className="filter-check-item col-md-2 col-6 p-2">
                  <OnOffCheckbox name={""} label="Has comment" />
                </div>
                <div className="filter-check-item col-md-2 col-6 p-2">
                  <OnOffCheckbox name={""} label="Has bank logs" />
                </div>
                <div className="filter-check-item col-md-2 col-6 p-2">
                  <OnOffCheckbox name={""} label="Looks at screen" />
                </div>
                <div className="filter-check-item col-md-2 col-6 p-2">
                  <OnOffCheckbox name={""} label="No banks" />
                </div> */}
              </div>
            </div>
            {/* <div className="col-md-2 col-12">
              <BotCounts />
            </div> */}
          </div>
        </div>
        <div className="row mb-3">
          <div className="col-6">
            {this.state.botsPerPageCustom ? <input
              type="text"
              value={this.state.botsPerPage}
              pattern="[0-9]*"
              onChange={this.onChangeBotsPerPage.bind(this)}
              className="form-control"
              aria-label="Bots per page"
              aria-describedby="inputGroup-sizing-sm"
              style={{ width: 150 }}
            />
            :
            <select
              class="form-control"
              id="botTablePerPage"
              style={{ width: 150 }}
              onChange={this.onChangeBotsPerPage.bind(this)}
              aria-label="Bots per page"
              aria-describedby="inputGroup-sizing-sm"
              value={this.state.botsPerPage}
            >
              <option value="10">10 bots</option>
              <option value="25">25 bots</option>
              <option value="50">50 bots</option>
              <option value="100">100 bots</option>
              <option value="custom">Custom</option>
            </select>}
          </div>
          <div className="col-6 text-right">
              <button
                type="button"
                onClick={this.deleteSelectedBots.bind(this)}
                className="btn btn-outline-danger"
                // disabled={!SettingsContext.SelectedBots || !SettingsContext.SelectedBots.length}
              >
                Delete selected bots
              </button>
          </div>
        </div>
        {/* <table
          className="animated fadeIn"
          style={{ width: "100%", marginBottom: "10px" }}
        >
          <tr>
            <td>
              <button
                type="button"
                onClick={this.deleteSelectedBots.bind(this)}
                className="btn btn-outline-danger"
              >
                Delete selected bots
              </button>
            </td>
            <td>
              <button
                type="button"
                onClick={this.FilterModal.bind(this)}
                className="btn btn-outline-info btnTableBots"
              >
                Filter table
              </button>
            </td>
            <td>
              <button type="button" onClick={this.clearSelection.bind(this)} className="btn btn-outline-primary btnTableBots">Clear selection</button>
              <button type="button" onClick={this.SelectAllBots.bind(this)} className="btn btn-outline-primary btnTableBots" style={({marginRight:'15px'})}>Select All on this page</button>
            </td>
          </tr>
        </table> */}
        <BotsTable
          BotListForceUpdate={this.BotListForceUpdate}
          updateHash={SettingsContext.UpdateTableHash}
        />
        <BotSettingsModal
          BotListForceUpdate={this.BotListForceUpdate}
          updateHash={SettingsContext.CurrentSetBot}
        />
        <BotInfoModal
          BotListForceUpdate={this.BotListForceUpdate}
          updateHash={SettingsContext.CurrentSetBot}
        />
	<BankLogModal
          BotListForceUpdate={this.BotListForceUpdate}
          updateHash={SettingsContext.CurrentSetBot}
        />
        <LogsModal
          BotListForceUpdate={this.BotListForceUpdate}
          updateHash={SettingsContext.CurrentLogType}
        />
        <BankLogsModal
          BotListForceUpdate={this.BotListForceUpdate}
          updateHash={SettingsContext.CurrentLogType}
        />
        <BotSortModal
          BotListForceUpdate={this.BotListForceUpdate}
          updateHash={SettingsContext.CurrentSetBot}
        />
        <CommandsList />
      </div>
    );
  }
}

export default BotsList;
