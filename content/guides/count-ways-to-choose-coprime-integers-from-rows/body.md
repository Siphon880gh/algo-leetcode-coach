## Inclusion–exclusion on the gcd

1. V = the largest value.
2. For d = V … 1: f = Π over rows of (entries divisible by d); g[d] = f − Σ g[k·d] for k ≥ 2.
3. Return g[1] mod 10^9 + 7.

Examples → 3, 0. Checked against trying every choice on 500 random small matrices.

Not subtracting the multiples: example 1 → 4 instead of 3.

Time: O(V · m · n)  
Space: O(V)

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
