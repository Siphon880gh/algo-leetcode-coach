## Two sweeps

1. suf[n] = 1; suf[i] = min(CAP, suf[i + 1] · nums[i]) with CAP = 2 · 10^14.
2. s = 0; for i from 0: if s = suf[i + 1], return i; s += nums[i].
3. Return −1.

The cap avoids overflow and never hides a match, since sums stay below 10^14. Multiply with a check (or 128-bit) before capping.

Examples → 1, 2, −1. Checked against direct sums and products on 3,000 random arrays.

Including nums[i] in the left sum: example 1 → 0 instead of 1.

Time: O(n)  
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
