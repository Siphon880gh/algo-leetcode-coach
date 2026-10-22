## Sieve, then scan

1. Sieve smallest prime factors up to 10^6.
2. For i from n − 2 down: if nums[i] > nums[i + 1], fail if it is prime; else nums[i] = spf, ops += 1, fail if still greater.

Examples → 1, −1, 0. Checked against every choice of reductions on 400 random arrays.

Scanning left to right: [4, 9, 6] → −1 instead of 2.

Time: O(M log log M + n)  
Space: O(M)

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
