## Circular pick DP

1. c[i] = max(0, max(left, right) + 1 − nums[i]) with circular neighbors.
2. k = 0 → 0. n = 2 → min(c) for k = 1.
3. Otherwise run a linear DP (count, last taken) twice: on 1 … n − 1, and c[0] plus k − 1 picks from 2 … n − 2.
4. Return the smaller, or −1 when neither can reach k.

Examples → 1, 0, −1. Checked against trying every set of increments on 500 random arrays.

Treating the array as linear: example 2 → −1 instead of 0.

Time: O(n · k)  
Space: O(k)

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
