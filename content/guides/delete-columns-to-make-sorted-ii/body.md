## Greedy left to right

`settled[i]` is true once rows `i` and `i + 1` are strictly ordered by the kept columns.

For each column `j`:

1. If some `i` has `not settled[i]` and `strs[i][j] > strs[i + 1][j]`, this column breaks the order: delete it (`ans += 1`) and move on.
2. Otherwise keep it, and set `settled[i] = true` for every `i` with `strs[i][j] < strs[i + 1][j]`.

Return `ans`.

Keeping a column never hurts if it does not break anything: it can only settle more pairs. Settled pairs ignore later columns because the earlier difference already decides their order.

Do not judge each column on its own as in part I; whole rows are compared. Do not settle pairs in a column you deleted.

Time: O(n · m)  
Space: O(n)

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
