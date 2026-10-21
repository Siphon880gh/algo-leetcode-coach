## Try every point

1. For `x, y` in `0 .. 50` (x outer): quality = Σ `⌊q / (1 + d)⌋` for towers with Euclidean `d ≤ radius`.
2. Update only on strictly greater quality, so the lexicographically smallest point wins ties.

`[[1,2,5],[2,1,7],[3,1,9]]`, 2 → `[2,1]`. `[[23,11,21]]`, 9 → `[23,11]`. `[[1,2,13],[2,1,7],[0,1,9]]`, 2 → `[1,2]`.

If every quality is 0, the answer is `[0,0]`. Floor each tower's term separately, not the sum.

Time: O(51² · T)  
Space: O(1)

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
