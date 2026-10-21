## Monotone in length

`dup(L)`: compute a polynomial rolling hash of every length-`L` window. Store `hash → start positions`; on a repeat, compare the actual substrings and return the start if they match.

Binary search `L` from 1 to `n − 1`, keeping the last length that returned a start. Return that substring, or `""`.

Use a large modulus (or two moduli) to keep collisions rare; the direct comparison keeps the answer correct.

Do not compare all pairs of substrings; that is far beyond O(n log n). A suffix array with the LCP array is the deterministic alternative: the answer is the largest LCP between adjacent suffixes.

Time: O(n log n) expected  
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
