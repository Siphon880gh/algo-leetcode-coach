## Per subset

1. For each mask: B = chosen elements, AND(B) (0 if empty); rest has XOR X.
2. Build a XOR basis of r & ~X for r in the rest; best = its maximum XOR.
3. Value = AND(B) + X + 2 · best; answer the maximum.

Examples → 5, 6, 15. Checked against all 3^n labelings on 300 random arrays.

Leaving C empty: example 3 → 14 instead of 15.

Time: O(2^n · n · log M)  
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
