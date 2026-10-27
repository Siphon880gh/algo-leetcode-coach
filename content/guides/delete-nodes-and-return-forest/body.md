## Decide on the way back up

`dead = set(to_delete)`, `forest = []`. `dfs(node, is_root)`:

1. If `node` is null, return null.
2. `deleted = node.val in dead`.
3. If `is_root` and not `deleted`, append `node` to `forest`.
4. `node.left = dfs(node.left, deleted)`; `node.right = dfs(node.right, deleted)`.
5. Return null if `deleted`, else `node`.

Call `dfs(root, True)`.

Returning null for deleted nodes unlinks them from their parents in the same pass.

Do not delete nodes top-down and then search for orphaned subtrees; one pass handles both. Use a set for `to_delete`; scanning the list for each node is O(n · k).

Time: O(n)  
Space: O(h + k)

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
