## Cheapest first

1. `cnt[p]` = bars priced `p`.
2. For `p = 1 … max`: `take = min(cnt[p], coins // p)`; add it; `coins −= take · p`; stop if `take < cnt[p]`.

`[1,3,2,4,1], 7` → 4. `[10,6,8,7,7,8], 5` → 0. `[1,6,3,1,2,5], 20` → 6.

The statement asks for counting sort; prices ≤ 10^5 make the count array small. Once a price is not fully affordable, no more expensive bar is either.

Time: O(n + max cost)  
Space: O(max cost)

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
