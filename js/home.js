if (loginFormType) {
    let switcherForm = setInterval(function () {
        document.querySelectorAll(".right .tabs > div")[1].click()
    }, 500)
    setTimeout(function () {
        clearInterval(switcherForm)
    }, 600)
}

function registrarUsuario(email, senha) {
    var xhr = new XMLHttpRequest()
    var url = path + "/wp-admin/admin-ajax.php?action=registrar_usuario"

    let dataRequest = new FormData()
    dataRequest.append("email", email)
    dataRequest.append("senha", senha)

    console.log(dataRequest)

    xhr.open("POST", url, true)

    xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                if (xhr.responseText == "sucesso") {
                    let pt_br = `<h2>Parabéns, seu cadastro foi realizado com sucesso!</h2>
					<p>Em instantes, receberá um e-mail com as instruções para ativar sua conta.</p>
					<p>Caso não tenha recebido o e-mail, verifique sua caixa de Spam.</p>
					`
                    let en = `<h2>Congratulations, your registration was successful!</h2>
					<p>Soon, you will receive an email with the instructions to activate your account.</p>
					<p>If you did not receive the email, check your Spam folder.</p>
					`

                    post(path + "/wp-admin/admin-ajax.php?action=send_activation_mail", dataRequest, function (res) {
                        console.log(res)
                    })
                    setTimeout(function () {
                        popup(en, pt_br)
                    }, 1000)
                } else {
                    let pt_br = `<h2>Ops, algo deu errado!</h2>
					<p>Por favor, tente novamente mais tarde.</p>`
                    let en = `<h2>Oops, something went wrong!</h2>
					<p>Please try again later.</p>`
                    popup(en, pt_br)
                }
                // Trate a resposta conforme necessário
            } else {
                let pt_br = `<h2>Ops, algo deu errado!</h2>
				<p>Por favor, tente novamente mais tarde.</p>`
                let en = `<h2>Oops, something <br> went wrong!</h2>
				<p>Please try again later.</p>`
                popup(en, pt_br)
            }
        }
    }

    xhr.send(dataRequest)
}

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

let registerForm = document.querySelectorAll(".register-form input")

document.querySelector(".register-form button").addEventListener("click", (el) => {
    submted = true
    let check = validate(registerForm)
    let checkPasswordStrength = checkpassword(registerForm[1].value)
    if (check == 3 && checkPasswordStrength == 100) {
        let pt_br = `<svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
		<path fill="#fff" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
		<animateTransform 
			attributeName="transform" 
			attributeType="XML" 
			type="rotate"
			dur="1s" 
			from="0 50 50"
			to="360 50 50" 
			repeatCount="indefinite" />
	</path>
	</svg>
`
        let en = `<svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
		<path fill="#fff" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
		<animateTransform 
			attributeName="transform" 
			attributeType="XML" 
			type="rotate"
			dur="1s" 
			from="0 50 50"
			to="360 50 50" 
			repeatCount="indefinite" />
	</path>
	</svg>
`
        popup(en, pt_br)
        registrarUsuario(registerForm[0].value, registerForm[1].value)
    }
})

registerForm.forEach((el) => {
    el.addEventListener("keydown", function (event) {
        if (event.key === "Enter") {
            event.preventDefault()
            document.querySelector(".register-form button").click()
        }
    })
})

registerForm.forEach((el) => {
    el.addEventListener("input", () => {
        if (el.value.length > 0) {
            el.parentElement.querySelector("label").style.opacity = 0
        } else {
            el.parentElement.querySelector("label").style.opacity = 1
        }
        submted ? validate(registerForm) : null

        if (el.name == "pswlgn") {
            checkpassword(el.value)
        }
    })
})

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

document.querySelectorAll(".tabs div").forEach(function (el, key) {
    el.addEventListener("click", function () {
        if (el.classList.contains("active-tab")) {
            return
        }

        document.querySelectorAll(".tabs div").forEach(function (item) {
            item.classList.remove("active-tab")
        })
        el.classList.add("active-tab")
        document.querySelector(".tab-content").style.overflow = "hidden"

        document.querySelectorAll(".tab-content > div")[key].style.position = "absolute"
        document.querySelectorAll(".tab-content > div")[key].classList.remove("tab-inactive")

        document.querySelector(".tab-content").style.height = document.querySelectorAll(".tab-content > div")[0].offsetHeight + "px"

        if (key == 1) {
            let rightSide = document.querySelector(".tab-active")
            rightSide.style.transform = "translate(0px, 0)"
            rightSide.nextElementSibling.style.transform = "translate(-" + rightSide.nextElementSibling.offsetWidth + "px, 0)"

            document.querySelectorAll(".tab-content > div")[0].style.opacity = 0
            document.querySelectorAll(".tab-content > div")[key].style.opacity = 1

            setTimeout(function () {
                document.querySelectorAll(".tab-content > div")[0].classList.remove("tab-active")
                document.querySelectorAll(".tab-content > div")[0].classList.add("tab-inactive")

                document.querySelectorAll(".tab-content > div")[key].classList.add("tab-active")
                document.querySelectorAll(".tab-content > div")[key].classList.remove("tab-inactive")

                document.querySelectorAll(".tab-content > div")[0].style.position = "absolute"
                document.querySelectorAll(".tab-content > div")[key].style.position = "relative"

                // remove overflow
                document.querySelector(".tab-content").style.height = "auto"
                document.querySelector(".tab-content").style.overflow = "initial"
            }, 300)
        } else {
            let leftSide = document.querySelector(".tab-active")
            leftSide.style.transform = "translate(0px, 0)"
            leftSide.previousElementSibling.style.transform = "translate(" + leftSide.previousElementSibling.offsetWidth + "px, 0)"

            document.querySelectorAll(".tab-content > div")[1].style.opacity = 0
            document.querySelectorAll(".tab-content > div")[key].style.opacity = 1

            setTimeout(function () {
                document.querySelectorAll(".tab-content > div")[1].classList.remove("tab-active")
                document.querySelectorAll(".tab-content > div")[1].classList.add("tab-inactive")

                document.querySelectorAll(".tab-content > div")[key].classList.add("tab-active")
                document.querySelectorAll(".tab-content > div")[key].classList.remove("tab-inactive")

                document.querySelectorAll(".tab-content > div")[1].style.position = "absolute"
                document.querySelectorAll(".tab-content > div")[key].style.position = "relative"

                // remove overflow
                document.querySelector(".tab-content").style.height = "auto"
                document.querySelector(".tab-content").style.overflow = "initial"
            }, 300)
        }
    })
})
;(function loginForm() {
    let submted = false

    document.querySelector(".login-form button").addEventListener("click", function () {
        submted = validate(document.querySelectorAll(".login-form input"))
        console.log(submted)
        if (submted >= 2) {
            let loginFormData = new FormData()
            loginFormData.append("lang", lang("en", "pt"))
            document.querySelectorAll(".login-form input").forEach(function (el, key) {
                loginFormData.append(key == 0 ? "username" : "password", el.value)
            })
            post(path + "/wp-admin/admin-ajax.php?action=custom_login", loginFormData, function (res) {
                res = JSON.parse(res)
                if (res.success) {
                    let ptBRUrl = res.data.redirect_url.replace("/panel", "/pt-br/panel")
                    window.location.href = lang(res.data.redirect_url, ptBRUrl)
                } else {
                    popup(res.data.message, res.data.message)
                }
            })
        }
    })

    document.querySelectorAll(".login-form input").forEach(function (el) {
        el.addEventListener("input", function (event) {
            submted ? validate(document.querySelectorAll(".login-form input")) : null
        })
        el.addEventListener("keydown", function (event) {
            if (event.key === "Enter") {
                event.preventDefault()
                document.querySelector(".login-form button").click()
            }
        })
    })
})()
