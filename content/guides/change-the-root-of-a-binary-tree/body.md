Each node has a parent pointer. Given the root and a leaf, re-root the tree at the leaf by walking from the leaf up to (not including) the root: each node on that path moves an existing left child to its right side and adopts its old parent as its left child, with the parent dropping its link to it and all parent pointers updated, as the statement specifies. For instance, with root 1 (left 2, right 3) and leaf 2, the new root is 2, whose left child is 1, which keeps its right child 3. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Walk up and flip

1. `cur = leaf`, `prev = None`.
2. While `cur` is not null: `p = cur.parent`; set `cur.parent = prev`.
3. If `p` exists: clear `p`'s pointer to `cur` (left or right).
4. If `cur ≠ root` (it has a parent): move `cur.left` to `cur.right` if there is one, then `cur.left = p`.
5. `prev = cur`, `cur = p`. Return `leaf`.

Constructed check: root 1 (left 2, right 3), leaf 2 → 2 with left 1; 1 keeps right 3 and its parent is 2.

Clear the parent's pointer before reattaching, or the tree gets a cycle. Update every parent pointer, not just the child links. Constructed check 2: simulating it on [3,5,1,6,2,0,8,null,null,7,4] with leaf 7 gives [7,2,null,5,4,3,6,null,null,null,1,null,null,0,8].

Time: O(h)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
