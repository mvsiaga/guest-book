<template>
  <div>
    <b-card class="mt-5 mb-4">
      <a :href="route('home')" class="btn btn-secondary">Back</a>
      <b-button variant="success" v-b-modal.modal-create-guest>Add Guest</b-button>
    </b-card>

    <b-alert show dismissible variant="success" v-if="success.delete">Successfully deleted!</b-alert>
    <b-alert show dismissible variant="success" v-if="success.create">Successfully created!</b-alert>
    <b-card no-body header="Guest List" header-tag="header" class="mb-5">
      <b-table striped hover :items="guestList" empty-text>
        <template slot="actions" slot-scope="row">
          <b-button
            variant="primary"
            v-b-modal.modal-update-guest
            @click="showGuest(row.item.actions)"
          >Edit</b-button>
          <b-button variant="danger" @click="deleteGuest(row.item.actions)">Delete</b-button>
        </template>
        <template slot="empty" slot-scope="scope">
          <h4>{{ scope.emptyText }}</h4>
        </template>
      </b-table>
    </b-card>

    <!-- Create guest modal -->
    <b-modal
      ref="modal-create-guest"
      @ok="handleOkCreateGuest"
      id="modal-create-guest"
      title="Create Guest"
      ok-title="Submit"
    >
      <b-form ref="form" @submit.stop.prevent="handleOkCreateGuest">
        <b-form-group
          :state="stateCreate.firstName"
          invalid-feedback="This field is required."
          label="First name"
          label-for="createFirstName"
        >
          <b-form-input
            id="createFirstName"
            v-model="formCreate.firstName"
            :state="stateCreate.firstName"
            type="text"
            required
            placeholder="First name"
          ></b-form-input>
        </b-form-group>
        <b-form-group
          :state="stateCreate.lastName"
          invalid-feedback="This field is required."
          label="Last name"
          label-for="createLastName"
        >
          <b-form-input
            id="createLastName"
            v-model="formCreate.lastName"
            :state="stateCreate.lastName"
            type="text"
            required
            placeholder="Last name"
          ></b-form-input>
        </b-form-group>
        <b-form-group
          :state="stateCreate.email"
          invalid-feedback="This field must be an email."
          label="Email"
          label-for="createEmail"
        >
          <b-form-input
            id="createEmail"
            v-model="formCreate.email"
            :state="stateCreate.email"
            type="email"
            required
            placeholder="Email"
          ></b-form-input>
        </b-form-group>
        <b-form-group label="Phone number" label-for="createPhoneNumber">
          <b-form-input
            id="createPhoneNumber"
            v-model="formCreate.phoneNumber"
            type="text"
            placeholder="Phone number"
          ></b-form-input>
        </b-form-group>
        <b-form-group
          :state="stateCreate.gender"
          invalid-feedback="This field is required."
          label="Gender"
          label-for="editGender"
        >
          <b-form-select
            id="editGender"
            v-model="formCreate.gender"
            :state="stateCreate.gender"
            :options="genders"
            required
          ></b-form-select>
        </b-form-group>
        <b-form-group
          :state="stateCreate.address"
          invalid-feedback="This field is required."
          label="Address"
          label-for="createAddress"
        >
          <b-form-input
            id="createAddress"
            v-model="formCreate.address"
            :state="stateCreate.address"
            type="text"
            required
            placeholder="Address"
          ></b-form-input>
        </b-form-group>
      </b-form>
    </b-modal>

    <!-- Update guest modal -->
    <b-modal
      ref="modal-update-guest"
      @ok="handleOkUpdateGuest"
      id="modal-update-guest"
      title="Edit Guest"
      ok-title="Update"
    >
      <b-alert show dismissible variant="success" v-if="success.update">Successfully updated!</b-alert>
      <b-form ref="form" @submit.stop.prevent="handleSubmitUpdateGuest">
        <b-form-group
          :state="stateEdit.firstName"
          invalid-feedback="This field is required."
          label="First name"
          label-for="editFirstName"
        >
          <b-form-input
            id="editFirstName"
            v-model="formEdit.firstName"
            :state="stateEdit.firstName"
            type="text"
            required
            placeholder="First name"
          ></b-form-input>
        </b-form-group>
        <b-form-group
          :state="stateEdit.lastName"
          invalid-feedback="This field is required."
          label="Last name"
          label-for="editLastName"
        >
          <b-form-input
            id="editLastName"
            v-model="formEdit.lastName"
            :state="stateEdit.lastName"
            type="text"
            required
            placeholder="Last name"
          ></b-form-input>
        </b-form-group>
        <b-form-group
          :state="stateEdit.email"
          invalid-feedback="This field must be an email."
          label="Email"
          label-for="editEmail"
        >
          <b-form-input
            id="editEmail"
            v-model="formEdit.email"
            :state="stateEdit.email"
            type="email"
            required
            placeholder="Email"
          ></b-form-input>
        </b-form-group>
        <b-form-group label="Phone number" label-for="editPhoneNumber">
          <b-form-input
            id="editPhoneNumber"
            v-model="formEdit.phoneNumber"
            type="text"
            placeholder="Phone number"
          ></b-form-input>
        </b-form-group>
        <b-form-group
          :state="stateEdit.gender"
          invalid-feedback="This field is required."
          label="Gender"
          label-for="editGender"
        >
          <b-form-select
            id="editGender"
            v-model="formEdit.gender"
            :state="stateEdit.gender"
            :options="genders"
            required
          ></b-form-select>
        </b-form-group>
        <b-form-group
          :state="stateEdit.address"
          invalid-feedback="This field is required."
          label="Address"
          label-for="editAddress"
        >
          <b-form-input
            id="editAddress"
            v-model="formEdit.address"
            :state="stateEdit.address"
            type="text"
            required
            placeholder="Address"
          ></b-form-input>
        </b-form-group>
      </b-form>
    </b-modal>
  </div>
</template>

<script>
export default {
  data() {
    return {
      errors: [],
      success: {
        create: false,
        update: false,
        delete: false
      },
      guestList: [],
      formCreate: {
        id: "",
        firstName: "",
        lastName: "",
        email: "",
        phoneNumber: "",
        gender: "",
        address: ""
      },
      stateCreate: {
        firstName: "",
        lastName: "",
        email: "",
        gender: "",
        address: ""
      },
      formEdit: {
        id: "",
        firstName: "",
        lastName: "",
        email: "",
        phoneNumber: "",
        gender: "",
        address: ""
      },
      stateEdit: {
        firstName: "",
        lastName: "",
        email: "",
        gender: "",
        address: ""
      },
      genders: [{ text: "Select One", value: "" }]
    };
  },
  mounted() {
    this.getList();
    this.getGenders();
  },
  methods: {
    getList() {
      axios.get(route("guests.list")).then(resp => {
        let address = 0;
        this.guestList = [];
        resp.data.forEach(items => {
          if (items.address.length > 20) {
            address = `${items.address.substring(0, 20)}...`;
          } else {
            address = items.address;
          }

          this.guestList.push({
            first_name: items.first_name,
            last_name: items.last_name,
            email: items.email,
            phone_number: items.phone_number,
            gender: items.gender_value,
            address: address,
            actions: items.id
          });
        });
      });
    },
    getGenders() {
      axios.get(route("guests.genders")).then(resp => {
        resp.data.forEach(items => {
          this.genders.push({
            text: items.name,
            value: items.value
          });
        });
      });
    },
    checkCreateGuestFormValidity() {
      const valid = this.$refs.form.checkValidity();
      this.stateCreate.firstName = this.formCreate.firstName
        ? "valid"
        : "invalid";
      this.stateCreate.lastName = this.formCreate.lastName
        ? "valid"
        : "invalid";
      this.stateCreate.email = valid ? "valid" : "invalid";
      this.stateCreate.gender = this.formCreate.gender ? "valid" : "invalid";
      this.stateCreate.address = this.formCreate.address ? "valid" : "invalid";
      return valid;
    },
    checkUpdateGuestFormValidity() {
      const valid = this.$refs.form.checkValidity();
      this.stateEdit.firstName = this.formEdit.firstName ? "valid" : "invalid";
      this.stateEdit.lastName = this.formEdit.lastName ? "valid" : "invalid";
      this.stateEdit.email = valid ? "valid" : "invalid";
      this.stateEdit.gender = this.formEdit.gender ? "valid" : "invalid";
      this.stateEdit.address = this.formEdit.address ? "valid" : "invalid";
      return valid;
    },
    resetModal() {
      this.name = "";
      this.nameState = null;
    },
    handleOkCreateGuest(e) {
      e.preventDefault();
      this.handleSubmitCreateGuest();
    },
    handleSubmitCreateGuest() {
      if (this.checkCreateGuestFormValidity()) {
        this.createGuest();
      }
    },
    handleOkUpdateGuest(e) {
      e.preventDefault();
      this.handleSubmitUpdateGuest();
    },
    handleSubmitUpdateGuest() {
      if (this.checkUpdateGuestFormValidity()) {
        this.updateGuest();
      }
    },
    createGuest() {
      this.success.create = false;

      axios
        .post(route("guests.store"), {
          first_name: this.formCreate.firstName,
          last_name: this.formCreate.lastName,
          email: this.formCreate.email,
          phone_number: this.formCreate.phoneNumber,
          gender: this.formCreate.gender,
          address: this.formCreate.address
        })
        .then(resp => {
          if (resp.status == 200) {
            this.getList();
            this.success.create = true;
            this.$refs["modal-create-guest"].hide();

            this.formCreate.firstName = "";
            this.formCreate.lastName = "";
            this.formCreate.email = "";
            this.formCreate.phoneNumber = "";
            this.formCreate.gender = "";
            this.formCreate.address = "";

            this.stateCreate.firstName = "";
            this.stateCreate.lastName = "";
            this.stateCreate.email = "";
            this.stateCreate.gender = "";
            this.stateCreate.address = "";
          }
        });
    },
    showGuest(id) {
      this.success.update = false;
      this.formEdit.id = id;

      axios.get(route("guests.edit", id)).then(resp => {
        this.formEdit.firstName = resp.data.first_name;
        this.formEdit.lastName = resp.data.last_name;
        this.formEdit.email = resp.data.email;
        this.formEdit.phoneNumber = resp.data.phone_number;
        this.formEdit.gender = resp.data.gender;
        this.formEdit.address = resp.data.address;
      });
    },
    updateGuest() {
      axios
        .put(route("guests.update", this.formEdit.id), {
          first_name: this.formEdit.firstName,
          last_name: this.formEdit.lastName,
          email: this.formEdit.email,
          phone_number: this.formEdit.phoneNumber,
          gender: this.formEdit.gender,
          address: this.formEdit.address
        })
        .then(resp => {
          if (resp.status == 200) {
            this.getList();
            this.success.update = true;

            this.stateEdit.firstName = "";
            this.stateEdit.lastName = "";
            this.stateEdit.email = "";
            this.stateEdit.gender = "";
            this.stateEdit.address = "";
          }
        });
    },
    deleteGuest(id) {
      this.success.delete = false;

      if (confirm("Are your sure?")) {
        axios.delete(route("guests.destroy", id)).then(resp => {
          if (resp.status == 200) {
            this.success.delete = true;
            this.getList();
          }
        });
      }
    },
    route: route
  }
};
</script>