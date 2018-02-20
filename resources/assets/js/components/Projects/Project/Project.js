import React, {Component} from 'react';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/css/bootstrap-theme.css';
import { Button, ButtonGroup, Glyphicon } from 'react-bootstrap';
import './Project.css';

const project = (props) => (
    <tr>
        <td className='td'> {props.id} </td>
        <td className='td'> {props.projectName} </td>
        <td className='td'>
            <ButtonGroup size="sm">
                <Button
                    bsStyle="success"
                    onClick={props.clicked}>
                    <Glyphicon glyph="play" />
                </Button>
                <Button bsStyle="info">
                    <Glyphicon glyph="edit" />
                </Button>
                <Button bsStyle="danger">
                    <Glyphicon glyph="remove" />
                </Button>
            </ButtonGroup>
        </td>
    </tr>
);

export default project;