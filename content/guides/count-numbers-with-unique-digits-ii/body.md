You are given two positive integers a and b. Return how many integers in the range from a to b, inclusive, have no repeated digit. Limits are in the official statement. For instance, a = 1, b = 20 → 19 (only 11 repeats a digit), and a = 80, b = 120 → 27. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Count up to x

This assumes the range is inclusive at both ends, as restated above.

1. Direct check: for each v in [a, b], keep v if its digits are all different (len(set(str(v))) = len(str(v))). Fine when b − a is small.
2. Digit count f(x): add every shorter length l (9 · 9 · 8 · … with l factors), then walk the digits of x; at each position, for each smaller unused digit (no leading 0) add the ways to fill the rest with unused digits; stop if a digit repeats; add 1 if x itself qualifies.
3. Answer = f(b) − f(a − 1).

Constructed checks (run in code): the examples above; f matched the direct check on 3,000 random ranges up to 6,000. f(10^10) = 8,877,690, so the count of such numbers is bounded no matter how large b is.

Subtracting f(a) instead of f(a − 1) drops a itself when it qualifies: a = b = 12 → 0 instead of 1.

Time: O(b − a) direct, or O(10 · digits) counted  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
