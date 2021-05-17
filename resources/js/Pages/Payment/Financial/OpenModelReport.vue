<template>
        <v-dialog
            v-model="dialog"
            fullscreen
            hide-overlay
            transition="dialog-bottom-transition"
        >
            <template v-slot:activator="{ on, attrs }">
                <v-btn
                    color="warning"
                    dark
                    v-bind="attrs"
                    v-on="on"
                >
                    View
                </v-btn>
            </template>
            <v-card>
                <v-toolbar
                    dark
                    color="primary"
                >
                    <v-btn
                        icon
                        dark
                        @click="dialog = false"
                    >
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-toolbar-title>Cheque Payment Report</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                        <v-btn
                            dark
                            text
                            @click="printCheque()"
                        >
                            Generate
                        </v-btn>
                    </v-toolbar-items>
                </v-toolbar>

                <v-divider></v-divider>
                <v-list
                    three-line
                    subheader
                >
                    <v-subheader>General</v-subheader>
                    <v-list-item>
                        <v-list-item-action>
                            <v-checkbox v-model="notifications"></v-checkbox>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>Notifications</v-list-item-title>
                            <v-list-item-subtitle>Notify me about updates to apps or games that I downloaded</v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item>
                        <v-list-item-action>
                            <v-checkbox v-model="sound"></v-checkbox>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>Sound</v-list-item-title>
                            <v-list-item-subtitle>Auto-update apps at any time. Data charges may apply</v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item>
                        <v-list-item-action>
                            <v-checkbox v-model="widgets"></v-checkbox>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>Auto-add widgets</v-list-item-title>
                            <v-list-item-subtitle>Automatically add home screen widgets</v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
            </v-card>
        </v-dialog>
</template>

<script>
import {jsPDF} from "jspdf";

export default {

    data () {
        return {
            dialog: false,
            notifications: false,
            sound: true,
            widgets: false,
        }
    }
    ,
    props:[
        'amounts',
        'acceptCheque',
        'rejectCheque',
        'pendingCheque',
        'oneTimeAmount',
        'dailyPayments',
        'orderSales',
        'stocksPrices',
        'pendingAmount',
        'chequeReport'
    ],
    methods:{
        printCheque(){
            const columns = [
                { title: "CHEQUE NO", dataKey: "chequeNo" },
                { title: "PAYMENT ID", dataKey: "payment_id" },
                { title: "ORDER ID", dataKey: "order_id" },
                { title: "AMOUNT", dataKey: "amount" },
                { title: "UPLOAD DATE", dataKey: "created_at" },
                { title: "AGENT ID", dataKey: "agent_id" },
                { title: "CHEQUE DATE", dataKey: "date" },
                { title: "ACTION", dataKey: "status" },
                { title: "HANDLED BY", dataKey: "admin_id" },
                { title: "ACTION TIME", dataKey: "updated_at" }

            ];
            const doc = new jsPDF('landscape', 'pt','a4'

            );
            doc.setFontSize(16).text("Pharmac Online Pharmaceutical distributors (PVT).Ltd", 50, 50);

            doc.setFontSize(12).text("45, Station Street, Kandy", 50, 70);

            doc.setFontSize(12).text("Tele: 0724514263", 50, 90);
            // create a line under heading
            doc.setLineWidth(0.01).line(0.5, 100, 1200, 100);

            doc.setFontSize(13).text("Report: All Cheques Details", 50, 120);

            doc.setFontSize(10).text("Generated : " + new Date(), 250, 90);
            // Using autoTable plugin
            doc.autoTable({
                margin: { top: 130 },
                columns,
                body: this.chequeReport
            });

            doc.setLineWidth(0.01).line(0.5, doc.internal.pageSize.height - 40, 1200, doc.internal.pageSize.height - 40);

            // Creating footer and saving file
            doc
                .setFont("times")
                .setFontSize(11)
                .setTextColor(0, 0, 255)
                .text(
                    "@2021 Pharmac(PVT).Ltd",
                    20,
                    doc.internal.pageSize.height - 20
                );
            doc.save("ChequeReport"+new Date()+".pdf");
        }
    }
}
</script>

<style scoped>

</style>
