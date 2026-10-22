## Ends inwards

1. `i = 0`, `j = n − 1`, `total = 0`.
2. While `i < j`: `total += nums[i] · 10^digits(nums[j]) + nums[j]`; `i++`, `j−−`.
3. If `i = j`, add `nums[i]`.
4. Return `total`.

Examples → 596, 673.

Multiplying by a power of ten avoids building strings. The total can reach about 5 · 10^11, so use 64-bit.

Time: O(n · digits)  
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
