import axios from 'axios';
export default function(to,from,next){
    axios.get(url+'auth').then(res=>{
       if(res.data.status ==='authenticated')
           next();
       else
        next('/')
    });
}