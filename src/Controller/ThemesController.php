<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Themes Controller
 *
 * @property \App\Model\Table\ThemesTable $Themes
 *
 * @method \App\Model\Entity\Theme[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ThemesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        
		$this->paginate = [
            'limit' => 10,
			'order' => ['id' => 'desc'],
        ];
		$themes = $this->paginate($this->Themes);

        $this->set(compact('themes'));
    }

    /**
     * View method
     *
     * @param string|null $id Theme id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $theme = $this->Themes->get($id, [
            'contain' => ['Domains', 'Indicators']
        ]);

        $this->set('theme', $theme);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $theme = $this->Themes->newEntity();
        if ($this->request->is('post')) {
            $theme = $this->Themes->patchEntity($theme, $this->request->getData());
			$theme->created_by = $this->request->session()->read('Auth.User.id');
            if ($this->Themes->save($theme)) {
				$this->__setInspectors('Themes', 'add', $theme->id);
                $this->Flash->success(__('Enregistrement effectué avec succès.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->erreur(__('Impossible d\'effectuer l\'enregistrement. Veuillez recommencer svp.'));
        }
        $this->set(compact('theme'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Theme id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $theme = $this->Themes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $theme = $this->Themes->patchEntity($theme, $this->request->getData());
			$theme->modified_by = $this->request->session()->read('Auth.User.id');
            if ($this->Themes->save($theme)) {
				$this->__setInspectors('Themes', 'edit', $theme->id);
                $this->Flash->success(__('Mise à jour effectuée avec succès.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->erreur(__('Impossible d\'effectuer la mise à jour. Veuillez recommencer svp.'));
        }
        $this->set(compact('theme'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Theme id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $theme = $this->Themes->get($id);
		$this->__setInspectors('Themes', 'delete', $theme->id);
        if ($this->Themes->delete($theme)) {
            $this->Flash->success(__('L\élément a été supprimé avec succès.'));
        } else {
            $this->Flash->erreur(__('Impossible de supprimer l\élément. Veuillez recommencer svp.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
