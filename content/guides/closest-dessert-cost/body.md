## 3^m per base

1. `go(i, cost)`: update `best` if `|cost − target|` is smaller, or equal with a lower cost.
2. Stop if `i == m` or `cost ≥ target` (adding more only moves further away).
3. Else recurse with `0`, `1`, `2` of topping `i`.

`[1,7], [3,4], 10` → 10. `[2,3], [4,5,100], 18` → 17. `[3,10], [2,5], 9` → 8. Constructed: `[10], [1], 8` → 10 (the base alone exceeds the target).

Check the base alone before adding toppings. On ties prefer the lower cost, as the statement asks.

Time: O(n · 3^m)  
Space: O(m)

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
