## Return an arm, record a path

`arm(node)` is the longest downward path, in edges, from `node` through nodes with `node.val`:

- `l = arm(node.left)`, `r = arm(node.right)`.
- `left = l + 1` if the left child exists and has the same value, else 0. Likewise `right`.
- Update `best = max(best, left + right)`, the path bending at `node`.
- Return `max(left, right)`; a path going up to the parent can use only one side.

Length is counted in **edges**, so a single node gives 0.

Do not return `left + right` to the parent; a path cannot fork. Do not stop recursing when a child's value differs; that child can still hold its own longer path deeper down.

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
