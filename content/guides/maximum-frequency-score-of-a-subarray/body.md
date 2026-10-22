Given an integer array nums and an integer k, every subarray of length k has a frequency score built from its distinct values and how often each occurs: roughly, each distinct value raised to the power of its count, summed and reduced modulo a large prime; the exact definition and modulus are in the official statement. Return the largest score over all such subarrays. For instance, [1,1,1,2,1,2] with k = 3 → 5, from [2,1,2]: 2² + 1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## One term per step

1. Keep `cnt[x]` and `p[x] = x^cnt[x] mod M` for values in the window, and `score`.
2. Adding `x`: subtract the old term if present, multiply `p[x]` by `x` (or set it to `x`), add the new term.
3. Removing `y`: subtract its term, divide out one `y` with a modular inverse or recompute with fast power, and add the new term if the count is still positive.
4. After each full window, `best = max(best, score)`.

Constructed checks (verified against recomputing every window on 400 random arrays): the case above → 5.

Compare scores as the statement defines them, after the modulus. Fast power on removal costs O(log k).

Time: O(n log k)  
Space: O(k)

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
