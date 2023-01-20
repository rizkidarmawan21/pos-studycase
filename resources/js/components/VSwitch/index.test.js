import { mount } from "@vue/test-utils";
import { describe, expect, test } from "vitest";
import VSwitch from "./index.vue";

describe("switch component", () => {
    test("test input checkbox display correct style", () => {
        const wrapper = mount(VSwitch);
        const divElement = wrapper.find("div");
        const inputWithTypeCheckbox = wrapper.find("input");
        const labelElement = wrapper.find("label");
        expect(inputWithTypeCheckbox.attributes("type")).toBe("checkbox");
        expect(inputWithTypeCheckbox.attributes("id")).toBe("toggle");
        expect(labelElement.attributes("for")).toBe("toggle");
        expect(divElement.classes()).toStrictEqual(["form-switch"]);
    });
});
