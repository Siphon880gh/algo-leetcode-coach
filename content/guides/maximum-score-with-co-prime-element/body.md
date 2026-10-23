## Two cases

1. mult[d] = number of elements divisible by d.
2. share(v) = n − Σ μ(d) · mult[d] over squarefree d dividing v.
3. Keep an element v: score v − (share(v) − [v > 1]), since it shares with itself.
4. Change one element to v ≤ maxVal: pick an element that already clashes if there is one, so the cost is max(1, share(v)); score v − that.
5. Return the best score.

Examples → 4, 3, 1. Checked against trying every change on 400 small random cases.

Only keeping existing values: constructed check (run in code) nums = [1], maxVal = 7 → 1 instead of 6.

Time: O(V log V + maxVal · 2^ω), ω ≤ 6 distinct primes  
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
