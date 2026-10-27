## Greedy

1. suf[i] = MEX of nums[i …], from the right.
2. At i: t = suf[i]. t = 0 → append 0 for every remaining element and stop.
3. Otherwise take elements until all of 0 … t − 1 are seen, append t, continue.

Examples → [2, 1], [3], [0, 0]. Checked against every way to cut on 1,500 random arrays.

Taking the whole array at once: example 1 → [2] instead of [2, 1].

Time: O(n + V)  
Space: O(n + V)

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
