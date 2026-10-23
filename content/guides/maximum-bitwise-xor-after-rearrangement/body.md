## Greedy

1. c1 = ones in t, c0 = zeros.
2. For each s[i]: if s[i] = 0 and c1 > 0, use a 1 (bit 1); if s[i] = 1 and c0 > 0, use a 0 (bit 1); otherwise use what is left (bit 0).
3. Return the bits.

Examples → "110", "1101", "1111". Checked against every rearrangement on 1,500 random pairs.

Sorting t with its ones first: example 1 → "011" instead of "110".

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
