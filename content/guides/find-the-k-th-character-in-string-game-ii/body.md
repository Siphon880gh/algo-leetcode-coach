## Walk the bits

1. x = k − 1; s = 0; for i while x > 0: if x & 1 and operations[i] = 1, s += 1; x >>= 1.
2. Return a + (s mod 26).

Examples → a, b. Checked against building the word on 300 random cases. k ≤ 10^14 has 47 bits, so at most 47 operations matter.

Skipping the mod 26: 30 type-1 operations, k = 2^26 → { instead of a.

Time: O(log k)  
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
