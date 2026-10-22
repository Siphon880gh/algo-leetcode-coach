## Cancel high, add low

1. `c = popcount(num2)`, `x = 0`.
2. For bit `i = 30 … 0`: if `c > 0` and num1 has bit `i`, set it in `x` and `c−−`.
3. For bit `i = 0, 1, …` while `c > 0`: if bit `i` of `x` is clear, set it and `c−−`.
4. Return `x`.

Examples → 3, 3. Checked against trying every x below 1024 on 300 random cases.

A bit of num1 that x leaves out costs 2^i in the XOR, so keep the high ones. A bit x adds outside num1 also costs 2^i, so use the low ones. The result stays below 2^31.

Time: O(31)  
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
