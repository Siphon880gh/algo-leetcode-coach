## Groups mod g

1. `g = gcd(n, k)`.
2. For each `s = 0 … g − 1`: collect `arr[s], arr[s + g], …`; sort; add `Σ |x − median|`.
3. Return the total.

Examples → 1, 5. Checked against every target array with values 1 … 6 on 150 random small cases.

Moving the window by one swaps arr[i] for arr[i + k], so those must match; steps of k around a circle of n reach exactly the multiples of g. The median minimises the total distance. The total can reach about 5 · 10^13, so use 64-bit.

Time: O(n log n)  
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
