<template>
  <div class="dropdown border-0 select-dropdown" v-bind:data-name="name">
    <button
      type="button"
      class="btn btn-light text-muted d-flex justify-content-between align-items-center w-100 h-100 no-glow no-corner"
      data-toggle="dropdown"
      style="background: #e9ecef"
    >
      <span id="selectText" v-if="text">{{ text }}</span>
      <span id="selectText" v-else>Nothing Selected</span>
      <i id="selectIcon" class="material-icons pr-0">arrow_drop_down</i>
    </button>
    <ul class="dropdown-menu">
      <li class="dropdown-item" v-for="item in options" :key="item.id">
        <a :id="item.id">{{ item.type }}</a>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "select-dropdown",
  props: ["name", "text", "options"],
  computed: {},
  mounted() {
    var selects = document.getElementsByClassName("select-dropdown");

    // Process each custom select-dropdown on the page
    Array.prototype.forEach.call(selects, function (sel) {
      var btn = sel.getElementsByTagName("button")[0];
      var btnTxt = btn.getElementsByTagName("span")[0].innerHTML;
      var options = sel.getElementsByClassName("dropdown-item");

      // Toggle up/down icon on "select" button
      btn.addEventListener("click", toggleBtnIcon);

      // Option selection logic
      Array.prototype.forEach.call(options, function (option) {
        option.addEventListener("click", setSelectOption);
      });
    });

    // Detect click outside any select-dropdown element
    window.addEventListener("click", function (e) {
      var outside = [];
      Array.prototype.forEach.call(selects, function (sel) {
        var clickedOutside = !sel.contains(e.target);
        outside.push(clickedOutside);
      });
      if (!outside.includes(false)) {
        resetBtnIcon();
      }
    });

    /***************************************************************************/

    function setSelectOption() {
      var optionID = this.getElementsByTagName("a")[0].id;
      var optionText = this.getElementsByTagName("a")[0].innerHTML;
      var select = this.parentElement.parentElement;
      var btn = select.getElementsByTagName("button")[0];

      // Reset select icon
      resetBtnIcon();

      // Highlight selected option
      highlightSelectedOption(this);

      // Update selected option
      btn.getElementsByTagName("span")[0].innerHTML = optionText;
      btn.getElementsByTagName("span")[0].className = "text-primary";

      // Find the parent form element of the select
      var form = select.closest("form");

      // remove existing inputs matching the data-name
      var inputName;
      if (select.hasAttribute("data-name")) {
        inputName = select.dataset.name;
      } else {
        // default
        inputName = "select_input";
      }
      removeExistingInputs(form, inputName);

      // Add new hidden input to the form
      addNewInput(form, inputName, optionID);
    }

    function highlightSelectedOption(el) {
      // Remove style of all options
      var otherOptions = getSiblings(el);
      var i = 0;
      while (i < otherOptions.length) {
        otherOptions[i++].classList.remove("active");
      }

      // Add style to selected option only
      el.classList.add("active");
    }

    function addNewInput(form, name, value) {
      var input = document.createElement("input");
      input.type = "hidden";
      input.name = name;
      input.value = value;
      input.classList.add("d-none");
      form.appendChild(input);
    }

    function removeExistingInputs(form, name) {
      var existingInputs = document.getElementsByName(name);
      for (var i = 0; i < existingInputs.length; i++) {
        form.removeChild(existingInputs[0]);
      }
    }

    function toggleBtnIcon() {
      var btnIcon = this.getElementsByTagName("i")[0].innerHTML;
      switch (btnIcon) {
        case "arrow_drop_down":
          this.getElementsByTagName("i")[0].innerHTML = "arrow_drop_up";
          break;
        case "arrow_drop_up":
          this.getElementsByTagName("i")[0].innerHTML = "arrow_drop_down";
          break;
        default:
          this.getElementsByTagName("i")[0].innerHTML = "arrow_drop_down";
      }
    }

    function resetBtnIcon() {
      var selects = document.getElementsByClassName("select-dropdown");
      Array.prototype.forEach.call(selects, function (sel) {
        var btns = sel.getElementsByTagName("button");
        Array.prototype.forEach.call(btns, function (btn) {
          btn.getElementsByTagName("i")[0].innerHTML = "arrow_drop_down";
        });
      });
    }

    function getSiblings(elem) {
      // Setup siblings array and get the first sibling
      var siblings = [];
      var sibling = elem.parentNode.firstChild;

      // Loop through each sibling and push to the array
      while (sibling) {
        if (sibling.nodeType === 1 && sibling !== elem) {
          siblings.push(sibling);
        }
        sibling = sibling.nextSibling;
      }

      return siblings;
    }
  },
};
</script>
