## Thread the nodes as you visit them

`dummy = Node()`, `tail = dummy`.

`inorder(node)`:

1. If null, return.
2. `inorder(node.left)`.
3. `node.left = None`; `tail.right = node`; `tail = node`.
4. `inorder(node.right)`.

Return `dummy.right`.

Changing `node.left` is safe because the left subtree has already been visited. `node.right` is read in step 4 after the relink, but step 3 never changes `node.right`, so it still points at the right subtree.

Do not collect values and build new nodes unless allowed; reusing the nodes keeps extra space at O(h). Do not forget to clear left links; a leftover left link breaks the chain.

Time: O(n)  
Space: O(h)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
