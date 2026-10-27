Given two strings, return a shortest string that contains both as substrings; if several exist, any one is accepted. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two orders

1. If b is in a, return a; if a is in b, return b.
2. ov(x, y) = x + y[L:], L = the longest length with x ending in y[:L].
3. Return the shorter of ov(a, b) and ov(b, a).

Constructed checks (run in code): abc, bcd → abcd; xy, axyb → axyb; ab, ba → aba. Checked against every string up to the combined length on 200 random pairs.

Trying only a then b: bcd, abc → bcdabc instead of abcd.

Time: O((n + m)²) as written; KMP brings each overlap to O(n + m)  
Space: O(n + m)

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
