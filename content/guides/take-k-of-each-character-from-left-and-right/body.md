## Leave the longest window

1. Count each letter; if any count is below `k`, return −1.
2. `limit[c] = total[c] − k`. Slide `r`; add `s[r]`; while its count exceeds its limit, drop `s[l]` and `l++`. Track the longest window.
3. Return `n − longest`.

Examples → 8, −1. Checked against trying every left and right amount on 300 random strings.

Taking from both ends always leaves a contiguous middle, so minimizing taken characters means maximizing the middle. When k = 0 the whole string can stay, giving 0.

Time: O(n)  
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
