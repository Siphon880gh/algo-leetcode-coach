## Fill the zero bits

1. Walk the bits of n − 1 from low to high.
2. Place each one in the next zero bit of x (skipping x’s set bits).

Examples → 6, 15. Checked against listing the valid values for all n, x < 40.

Adding n − 1 directly fails: example 2 → 8, and 7 AND 8 = 0.

At n = x = 10^8 the answer is 409,632,367,103 (39 bits); use 64-bit.

Time: O(log n + log x)  
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
