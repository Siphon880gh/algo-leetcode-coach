## Tiny example

Recursive traversals on `1,(2,3)`:

- Preorder visit slot **before** both calls → `1,2,3`
- Inorder slot **between** calls → `2,1,3`
- Postorder slot **after** both calls → `2,3,1`

Same recursion skeleton; only the visit line moves.


## How

1. Write `visit; left; right` / `left; visit; right` / `left; right; visit`
2. Trace one tiny tree
3. Reuse for problems that need a specific order


## Trap

Assuming inorder always prints sorted values on non-BST trees.

**Fix:** Sorted inorder needs the BST invariant too.

**Time:** O(n) · **Space:** O(h)

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
