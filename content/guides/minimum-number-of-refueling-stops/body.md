## Decide stops after the fact

`fuel = startFuel`, `stops = 0`, max-heap `H`. Treat the target as a final station with 0 fuel.

For each station `(pos, gas)` in order:

1. While `fuel < pos`: if `H` is empty, return −1; else `fuel += pop(H)`, `stops += 1`.
2. Push `gas` into `H`.

Return `stops`.

`fuel` here means the farthest position you can reach. Popping the largest station passed so far gives the most range per stop, and choosing it late is fine because you could have stopped there when you passed it.

The DP `dp[t]` = farthest reach with `t` stops also works in O(n²).

Do not stop greedily at every station you reach. Do not forget the final check against `target`.

Time: O(n log n)  
Space: O(n)

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
