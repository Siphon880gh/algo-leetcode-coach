## Each shift applies to a prefix

`shifts[i]` shifts the first `i + 1` letters, so letter `j` is shifted by every `shifts[i]` with `i ≥ j`.

`total = 0`. For `i` from `n − 1` down to 0:

- `total = (total + shifts[i]) % 26`.
- `res[i] = chr((ord(s[i]) − 97 + total) % 26 + 97)`.

Taking the modulus as you go keeps the numbers small; shifts can be up to 10⁹ each.

Do not apply each shift to its prefix one by one; that is O(n²). Do not take the modulus only at the end in fixed-width languages; the sum can overflow.

Time: O(n)  
Space: O(n) for the result

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
