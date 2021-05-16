<!--suppress ALL -->
<template>
    <layout>


        <form @submit.prevent="submit"  class="col-lg-15 offset-lg-3" >

            <div class="form-group col-md-10">
                <!--suppress XmlInvalidId -->
                <label for="formGroupExampleInput"> Name</label>
                <div class="col-sm-10">
                    <input type="text" required placeholder="admin ID" class="form-control" v-model="form.admin_id">
                </div>
            </div>
            <div class="form-group col-md-10">
                <!--suppress XmlInvalidId -->
                <label for="formGroupExampleInput"> Tel.no</label>
                <div class="col-sm-10">
                    <input type="text" required placeholder="Min Ref" class="form-control"
                           v-model="form.minRefs">
                </div>
            </div>


            <div class="form-group col-md-10">
                <label for="formGroupExampleInput"> Accsess Level</label>
                <div class="col-sm-10">
                    <input type="text" required placeholder="point ref" class="form-control" v-model="form.pointPerRef">
                </div>
            </div>

            <button  type="submit" class="btn btn-behance"> Submit </button>
        </form>
    </layout>


</template>


<script>
export default {
    name: "AddCommission",


    data() {
        return {
            form: {
                admin_id: null,
                minRefs: null,
                pointPerRef: null,
            }
        }
    }
    ,
    methods: {
        submit: function() {

            this.$inertia.post('/getadd', this.form);
        }
    },

    print () {
        console.log(this.agents);
        const columns = [
            { title: "ID", dataKey: "id" },
            { title: "Email", dataKey: "email" },
            { title: "userName", dataKey: "userName" },
            { title: "Name", dataKey: "name" },
            { title: "Name", dataKey: "telephone" },
            { title: "NIC", dataKey: "NIC" }
        ];
        const doc = new jsPDF('p', 'pt'
            //orientation: "portrait",
            //unit: "in",
            //format: "letter"
        );
        doc.setFontSize(16).text("Pharmac Online Pharmaceutical distributors (PVT).Ltd", 50, 50);
        doc.setFontSize(12).text("45, Station Street, Kandy", 50, 70);
        doc.setFontSize(12).text("Tele: 0724514263", 50, 90);
        // create a line under heading
        doc.setLineWidth(0.01).line(0.5, 100, 1200, 100);
        doc.setFontSize(13).text("Report: All Agent Agent Details", 50, 120);
        doc.setFontSize(10).text("Generated : " + new Date(), 250, 90);
        // Using autoTable plugin
        doc.autoTable({
            margin: { top: 130 },
            columns,
            body: this.agents
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
        doc.save("AllAgents.pdf");
    },

}
</script>

<style scoped>

</style>
