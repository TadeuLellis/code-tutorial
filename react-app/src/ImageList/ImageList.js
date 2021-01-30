// exporta como padrão (default) um componente function de ImageList com propriedade (props)
export default function ImageList(props) {
    // renderiza o HTML
    return (
        <li>
            <img src={props.image.image} style={{width: '150px'}} />
        </li>
    )
}