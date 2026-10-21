## Shrink to candle boundaries

1. `pre[i]` = plates in `s[0 … i − 1]`; `right[i]` = first candle at index ≥ i; `left[i]` = last candle at index ≤ i.
2. Query `[a, b]`: `x = right[a]`, `y = left[b]`; answer `pre[y] − pre[x]` if `x < y`, else 0.

Examples → `[2,3]`, `[9,0,0,0,0]`. Checked against direct substring counting on random inputs.

Only plates between the outermost candles inside the range count, so trimming to those candles and taking a prefix difference answers each query in O(1). Binary search over candle positions is an equivalent alternative.

Time: O(n + q)  
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
