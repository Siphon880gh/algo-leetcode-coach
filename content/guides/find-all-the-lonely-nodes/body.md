Given a binary tree, return the values of all lonely nodes, meaning nodes that are the only child of their parent (the root is not lonely), in any order. For instance, in `[1,2,3,null,4]` only 4 is lonely. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Check at the parent

1. `dfs(node)`: if `left` and not `right`, add `left.val`; if `right` and not `left`, add `right.val`.
2. Recurse into both children.

`[1,2,3,null,4]` → `[4]`: node 2 has only a right child.

Do not mark the root. Do not mark leaves just for having no children; loneliness is about the siblings.

Time: O(n)  
Space: O(height)

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
