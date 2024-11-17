import { defineStore } from 'pinia'
export const useUserStore = defineStore({
    id: 'user',
	state: () => ( {
        user: { 
        //"id":"1",
        //"name":"Peter Kinget",
        //"email":"peter.kinget@gmail.com", 
        //"session_id":"s47fcd7q4f2tm6rhdgfubn53ov",   
        },
        tmp_user:{
		//"email":"abc@yahoo.com"
		//"name":"abc"
		//"password":"123456"			
		},
    }),
    getters: {
        getUser (state) {
            return state.user;
        },   
    }, 
    actions: {
		loginUser(user){
            this.user = user
        },
        logoutUser(){
            this.user = {}
        },
        tmpUser(user){
            this.tmp_user = user
        },	
        async userExistsDB(user) {
			try {
				const response = await fetch(`http://daw.deei.fct.ualg.pt/~a71483/LAB11/api/users.php?email=${user.email}`, {
					method: 'GET',
				})
                const data = await response.json()
				if ( data !== null) {
                    alert('Email already exists')
                    return true
                }
                else {
                    //remember temporary user
                    this.tmpUser(user)
                    return false
                }                   
			} 
			catch (error) {
				console.error(error)
				alert('Error: Database connection failed in phase 1')
				return false
			}
		}, 
        async addUserDB() {
			try {
                const response = await fetch('http://daw.deei.fct.ualg.pt/~a71483/LAB11/api/users.php', {
					method: 'POST',
					body: JSON.stringify(this.tmp_user),
					headers: { 'Content-type': 'text/html; charset=UTF-8' },
				})
				const data = await response.json()
                return true
			} 
			catch (error) {
				console.error(error)
				alert('Error: Database connection failed in phase 2')	
				return false			
			}
		},
        async loginUserDB(user) {
			try {
				const response = await fetch(`http://daw.deei.fct.ualg.pt/~a71483/LAB11/api/users.php?email=${user.email}&password=${user.password}`)
				const data = await response.json()
				if ( data == null) {
					alert('Error: Wrong credentials')
					return false
                }
                else {
					//add new user
					this.loginUser(data)
                    return true
                }

			} 
			catch (error) {
				console.error(error)
				alert('Error: Database connection failed')	
				return false			
			}
		}, 
        async logoutUserDB() {
			try {
				const response = await fetch(`http://daw.deei.fct.ualg.pt/~a71483/LAB11/api/users.php?session_id=${this.user.session_id}`)
				const data = await response.json()
                this.logoutUser()
				return true
			} 
			catch (error) {
				console.error(error)
				return false
			}
		},   
    }

})
