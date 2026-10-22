## Two states

1. Offsets p with rotate(s, p) = t: Z-function on t + # + s + s.
2. From offset 0, `f0` = ways to be at 0, `f1` = ways to be at each nonzero offset. One step: `f0' = (n − 1)·f1`, `f1' = f0 + (n − 2)·f1`.
3. Raise that matrix to k; add f0 if p = 0 is valid and f1 for each valid nonzero p, mod 10^9 + 7.

Examples → 2, 2. Checked against counting every operation sequence on 200 random small cases.

k reaches 10^15, so step the recurrence by squaring, not k times. A step can never stay at offset 0, since l is between 1 and n − 1.

Time: O(n + log k)  
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
