Given a numeric string that is a palindrome, return the smallest palindrome strictly larger than it that uses exactly the same digits, or an empty string if none exists. For instance, "1221" → "2112", "32123" → "", and "45544554" → "54455445". _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Permute the half

1. `h` = first `n // 2` digits.
2. Next permutation of `h`: rightmost `i` with `h[i] < h[i + 1]`; none → `""`. Swap with the rightmost larger digit, reverse the tail.
3. Return `h + middle + reversed(h)`.

Constructed checks (verified against all palindromic permutations): `"1221"` → `"2112"`, `"32123"` → `""`, `"45544554"` → `"54455445"`, `"121"` → `""`.

The middle digit of an odd-length palindrome never moves. Comparing halves is enough because the mirrored half follows from the first.

Time: O(n)  
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
