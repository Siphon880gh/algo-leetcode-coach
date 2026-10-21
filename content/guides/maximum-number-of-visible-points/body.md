## Angles on a circle

1. Points equal to `location` → `same += 1`; others → `atan2(dy, dx)` in degrees.
2. Sort; append each angle + 360 to handle wrap-around.
3. Two pointers: shrink while `a[i] − a[j] > angle`; best window size, capped at the original count.
4. Answer `best + same`.

`[[2,1],[2,2],[3,3]]`, 90, `[1,1]` → 3. Adding `[1,1]` itself → 4. `[[1,0],[2,1]]`, 13 → 1.

Use a small epsilon on the comparison for floating-point angles. Do not forget the +360 copies.

Time: O(n log n)  
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
