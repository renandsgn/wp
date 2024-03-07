let submted = false
function validate(obj) {
    let errorLength = false
    let error = []
    obj.forEach((el, key) => {
        switch (el.dataset.type) {
            case "mail":
                error[key] = lang("Insert an email", "Insira um email")
                !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(el.value) ? inputError(el, error[key]) : (removeError(el), errorLength++)
                break
            case "password":
                error[key] = lang("Insert a password", "Insira uma senha")
                el.value.length == 0 ? inputError(el, error[key]) : removeError(el), errorLength++
                break
            case "password-confirm":
                let error2 = lang("Passwords dont match", "Senhas não correspondem")
                let error1 = lang("Insert a password", "Insira uma senha")

                if (el.value.length > 0) {
                    error[key] = error2
                    if (el.value != obj[1].value) {
                        removeError(el)
                        inputError(el, error[key])
                        console.log(error[key])
                    } else {
                        removeError(el)
                        errorLength++
                    }
                } else {
                    error[key] = error1
                    removeError(el)
                    inputError(el, error[key])
                }
                break
        }
    })
    function inputError(arg, error) {
        if (arg.parentElement.querySelector(".error-msg") == null) {
            let styleError = `
                position: absolute;
                color: #fff;
                font-size: 13px;
                top: -12px;
                right: -2px;
                text-align: right;
                background-color: #fc4e4e;
                border-radius: 4px;
                padding: 4px 8px;
				z-index: 3;
            `
            arg.parentElement.insertAdjacentHTML("beforeend", `<span style="${styleError}" class='error-msg'>${error}</span>`)
        }
        errorLength = errorLength - 1
        if (errorLength < 0) {
            // errorLength = 0;
        }
    }
    function removeError(arg) {
        if (arg.parentElement.querySelector(".error-msg") != null) {
            arg.parentElement.querySelector(".error-msg").remove()
        }
    }
    function lang(str, str2) {
        let lang = document.cookie.split("; ").indexOf("language=en") > -1 ? "en" : "pt"
        return lang == "en" ? str : str2
    }
    return errorLength
}

let forgotForm = document.querySelectorAll(".forgot-form input")
let canPaste = false
document.querySelector("button.submit").addEventListener("click", function () {
    if (validate(forgotForm) == 1) {
        let forgotFormData = new FormData()
        forgotFormData.append("email", forgotForm[0].value)
        post(path + "/wp-admin/admin-ajax.php?action=forgot_password", forgotFormData, function (data) {
            if (data == "sucesso") {
                document.querySelectorAll(".forgot-form > *").forEach((el) => {
                    el.style.display = "none"
                    el.style.opacity = 0
                })
                document.querySelectorAll(".loading *, .loading").forEach((el) => {
                    el.style.opacity = "1"
                    el.style.display = "block"
                })
                post(path + "/wp-admin/admin-ajax.php?action=forgot_password_mail", forgotFormData, function (data) {
                    if (data == "erro") {
                        popup("Error sending email", "Erro ao enviar email")
                    } else {
                        canPaste = true

                        document.querySelector(".primary-title").style.opacity = "1"
                        document.querySelector(".primary-title").style.display = "block"

                        document.querySelectorAll(".forgot-form .reset-code")[1].focus()

                        document.querySelectorAll(".forgot-form .reset-code").forEach((el) => {
                            el.removeAttribute("style")
                        })
                        document.querySelectorAll(".forgot-form .reset-code").forEach((el) => {
                            el.style.opacity = "1"
                            el.querySelector("input") ? (el.querySelector("input").style.opacity = "1") : ""
                            el.classList.add("active-code")
                        })
                        document.querySelectorAll(".loading *, .loading").forEach((el) => {
                            el.style.opacity = "0"
                            el.style.display = "none"
                        })
                    }
                    mailCountDown()
                })
            } else {
                popup("Email not found", "Email não encontrado")
            }
        })
    }
})

forgotForm.forEach((el) => {
    el.addEventListener("keydown", function (event) {
        if (event.key === "Enter") {
            event.preventDefault()
            if (el.id == "usrwplgn") {
                document.querySelector(".forgot-form button").click()
            } else {
                document.querySelector(".send-code-button").click()
            }
        }
    })
})

document.body.addEventListener("paste", function (event) {
    let paste = (event.clipboardData || window.clipboardData).getData("text").trim()
    let valid = 0
    if (canPaste && paste.length >= 6) {
        event.preventDefault()

        let timing = [0, 200, 400, 650, 850, 1100]

        for (let i = 0; i < 6; i++) {
            let t = i + 1
            setTimeout(
                function () {
                    document.querySelectorAll(".forgot-form .reset-code")[t].querySelector("input").focus()
                    let ev = new MouseEvent("mouseover", { bubbles: true })
                    document.querySelectorAll(".forgot-form .reset-code")[t].querySelector("input").dispatchEvent(ev)
                    document.querySelectorAll(".forgot-form .reset-code")[t].querySelector("input").value = paste[i]

                    let typing = new KeyboardEvent("input", { key: paste[i], bubbles: true })
                    document.querySelectorAll(".forgot-form .reset-code")[t].querySelector("input").dispatchEvent(typing)

                    document.querySelectorAll(".forgot-form .reset-code input").forEach((el) => {
                        valid += el.value.length
                    })
                },

                timing[i] * 0.6
            )
        }
    }
})

for (let i = 0; i < 6; i++) {
    let t = i + 1
    let elements = document.querySelectorAll(".forgot-form .reset-code")[t].querySelector("input")
    elements.addEventListener("input", (key) => {
        let valid = false
        if (i != t && key.inputType == "deleteContentBackward") {
            let inpt = document.querySelectorAll(".forgot-form .reset-code")[t].querySelector("input").parentElement.previousElementSibling.querySelector("input")
            inpt != null ? inpt.focus() : ""
        }
        if (key.inputType != "deleteContentBackward" && t < 6) {
            document.querySelectorAll(".forgot-form .reset-code")[t].querySelector("input").parentElement.nextElementSibling.querySelector("input").focus()
        }
        document.querySelectorAll(".forgot-form .reset-code input").forEach((el) => {
            valid += el.value.length
        })

        if (valid >= 6) {
            document.querySelector("button.reset-code").removeAttribute("disabled")
        } else {
            document.querySelector("button.reset-code").setAttribute("disabled", true)
        }
    })
}

function mailCountDown() {
    let time = 50
    let countDwonInterval = setInterval(function () {
        if (document.querySelector(".countdown") != null) {
            if (time <= 0) {
                document.querySelector(".countdown").innerHTML = ""
                document.querySelector(".countdown").nextElementSibling.removeAttribute("disabled")
            } else {
                time--
                document.querySelector(".countdown").innerHTML = lang(`Wait ${time} seconds to try again`, `Aguarde ${time} segundos para tentar novamente`)
            }
        }
        if (document.querySelector(".countdown") == null) clearInterval(countDwonInterval)
    }, 1000)
    document.querySelector(".resend-trigger").addEventListener("click", function () {
        document.querySelectorAll('[name*="reset-code-"]').forEach(function (el) {
            el.value = ""
        })
        const element = this
        const saveOriginalText = this.innerHTML
        this.innerHTML = lang("Sending...", "Enviando...")
        let forgotFormData = new FormData()
        forgotFormData.append("email", forgotForm[0].value)
        post(path + "/wp-admin/admin-ajax.php?action=forgot_password", forgotFormData, function (data) {
            post(path + "/wp-admin/admin-ajax.php?action=forgot_password_mail", forgotFormData, function (data) {
                if (data == "erro") {
                    popup("Error sending email", "Erro ao enviar email")
                } else {
                    element.innerHTML = lang("Mail Sent", "Email enviado")
                    setTimeout(function () {
                        element.innerHTML = saveOriginalText
                        element.setAttribute("disabled", true)
                        time = 50
                        document.querySelector(".countdown").innerHTML = lang(`Wait ${time} seconds to try again`, `Aguarde ${time} segundos para tentar novamente`)
                    }, 3000)
                }
            })
        })
    })
}

document.querySelector(".send-code-button").addEventListener("click", function () {
    let strValue = forgotForm[1].value + forgotForm[2].value + forgotForm[3].value + forgotForm[4].value + forgotForm[5].value + forgotForm[6].value
    let forgotFormData = new FormData()
    forgotFormData.append("email", forgotForm[0].value)
    forgotFormData.append("code", strValue)
    post(path + "/wp-admin/admin-ajax.php?action=verify_reset_code", forgotFormData, function (data) {
        if (data == "erro") {
            popup("Invalid code", "Código inválido")
        } else {
            document.querySelector('input[name="email"]').value = forgotForm[0].value

            document.querySelector(".forgot-form").outerHTML = ""
            document.querySelector(".pwd-content").style.display = "block"

            let submted = false
            canPaste = false

            document.querySelector(".change-pwd-trigger").addEventListener("click", function () {
                submted = true
                checkPwd = validate(document.querySelectorAll(".pwd-content.wrapper-form input"))
                if (checkPwd >= 2) {
                    forgotFormData.append("password", document.querySelectorAll(".pwd-content.wrapper-form input")[1].value)
                    post(path + "/wp-admin/admin-ajax.php?action=change_password", forgotFormData, function (data) {
                        if (data == "erro") {
                            popup("Error changing password", "Erro ao alterar senha")
                        } else {
                            popup("Password changed", "Senha alterada")
                            document.querySelector(".popup .close").addEventListener("click", function () {
                                window.location.href = path + "?login=true"
                            })
                        }
                    })
                }
            })
            document.querySelectorAll(".pwd-content.wrapper-form input").forEach(function (el) {
                el.addEventListener("input", function (event) {
                    submted ? validate(document.querySelectorAll(".pwd-content.wrapper-form input")) : null
                })
                el.addEventListener("keydown", function (event) {
                    if (event.key === "Enter") {
                        event.preventDefault()
                        document.querySelector(".login-form button") != null ? document.querySelector(".login-form button").click() : document.querySelector(".pwd-content button.submit").click()
                    }
                })
            })
        }
    })
})

submted = false
function validate(obj) {
    let errorLength = false
    let error = []
    obj.forEach((el, key) => {
        switch (el.dataset.type) {
            case "mail":
                error[key] = lang("Insert an email", "Insira um email")
                !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(el.value) ? inputError(el, error[key]) : (removeError(el), errorLength++)
                break
            case "password":
                error[key] = lang("Insert a password", "Insira uma senha")
                el.value.length == 0 ? inputError(el, error[key]) : removeError(el), errorLength++
                break
            case "password-confirm":
                let error2 = lang("Passwords dont match", "Senhas não correspondem")
                let error1 = lang("Insert a password", "Insira uma senha")

                if (el.value.length > 0) {
                    error[key] = error2
                    if (el.value != obj[1].value) {
                        removeError(el)
                        inputError(el, error[key])
                        console.log(error[key])
                    } else {
                        removeError(el)
                        errorLength++
                    }
                } else {
                    error[key] = error1
                    removeError(el)
                    inputError(el, error[key])
                }
                break
        }
    })
    function inputError(arg, error) {
        if (arg.parentElement.querySelector(".error-msg") == null) {
            let styleError = `
                position: absolute;
                color: #fff;
                font-size: 13px;
                top: -12px;
                right: -2px;
                text-align: right;
                background-color: #fc4e4e;
                border-radius: 4px;
                padding: 4px 8px;
				z-index: 3;
            `
            arg.parentElement.insertAdjacentHTML("beforeend", `<span style="${styleError}" class='error-msg'>${error}</span>`)
        }
        errorLength = errorLength - 1
        if (errorLength < 0) {
            // errorLength = 0;
        }
    }
    function removeError(arg) {
        if (arg.parentElement.querySelector(".error-msg") != null) {
            arg.parentElement.querySelector(".error-msg").remove()
        }
    }
    function lang(str, str2) {
        let lang = document.cookie.split("; ").indexOf("language=en") > -1 ? "en" : "pt"
        return lang == "en" ? str : str2
    }
    return errorLength
}

function checkpassword(password) {
    let strengthbar = {}
    let strength = 0
    let passLegth = false
    let specifications = document.querySelectorAll(".password-specifications li")
    if (password.match(/[a-z]+/)) {
        strength += 1
    }
    if (password.match(/[A-Z]+/)) {
        strength += 1
        specifications[0].classList.add("passed")
    } else {
        specifications[0].classList.remove("passed")
    }
    if (password.match(/[0-9]+/)) {
        strength += 1
        specifications[1].classList.add("passed")
    } else {
        specifications[1].classList.remove("passed")
    }
    if (password.match(/[$@#&!]+/)) {
        strength += 1
        specifications[2].classList.add("passed")
    } else {
        specifications[2].classList.remove("passed")
    }
    if (password.length >= 8) {
        passLegth = true
        specifications[3].classList.add("passed")
    } else {
        passLegth = false
        specifications[3].classList.remove("passed")
    }

    if (passLegth) {
        strength += 1
    }

    if (strength >= 5 && passLegth) {
        setTimeout(function () {
            document.querySelector("#password-strength").style.transition = "opacity .3s ease-in-out"
            document.querySelector("#password-strength").style.opacity = 0
            setTimeout(function () {
                specifications[0].parentElement.classList.remove("pass-typing")
            }, 150)
            setTimeout(function () {
                document.querySelector("#password-strength").removeAttribute("style")
                document.querySelector("#password-strength").style.display = "none"
            }, 400)
        }, 200)
    } else {
        setTimeout(function () {
            document.querySelector("#password-strength").style.display = "block"
            specifications[0].parentElement.classList.add("pass-typing")
        }, 320)
    }

    switch (strength) {
        case 0:
            document.querySelector("#password-strength").className = "maximumweak"
            break
        case 1:
            strengthbar.value = 10
            document.querySelector("#password-strength").className = "veryweak"
            break

        case 2:
            strengthbar.value = 25
            document.querySelector("#password-strength").className = "weak"
            break

        case 3:
            strengthbar.value = 50
            document.querySelector("#password-strength").className = "medium"
            break

        case 4:
            strengthbar.value = 75
            document.querySelector("#password-strength").className = "strong"
            break

        case 5:
            strengthbar.value = 100
            document.querySelector("#password-strength").className = "verystrong"
            break
    }
    return strengthbar.value
}
