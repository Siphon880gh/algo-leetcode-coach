You get a lowercase string s. One operation either changes one letter to the next letter ('z' wraps to 'a') or moves the first character to the end. Return the fewest operations that make s a palindrome. It is the large-input version of Minimum Operations to Make a Rotated Palindrome I, so trying every rotation in O(n²) is too slow. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Convolution

1. cost(x, y) = min(|x − y|, 26 − |x − y|).
2. For each letter x: A_x = indicator of x, B_x = Σ_y cost(x, y) · indicator of y. C += A_x ⊛ B_x (cyclic, length n, via FFT).
3. C[c] counts each pair twice, so pair cost = C[c] / 2.
4. Answer = min over k of k + C[(2k + n − 1) mod n] / 2.

Constructed checks (made-up values, run in code): "az" → 1; "bcda" → 2; "qwerty" → 15. Matched the O(n²) rotation scan on 300 random strings. n = 5 · 10^4 ran in 0.2 s with numpy; round the FFT output to the nearest integer.

Using |x − y| without wrapping around the alphabet: "az" → 25 instead of 1.

Time: O(26 · n log n)  
Space: O(26 · n)

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
