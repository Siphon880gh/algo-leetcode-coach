You get a lowercase string s and an integer k. Two equal letters are close when their current positions differ by at most k. While a close pair exists, take the pair with the smallest left index (then the smallest right index) and delete the right letter; positions are counted in the current string. Return the final string. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Scan

1. last[c] = index in the result of the last kept c.
2. For each character: if last[c] exists and len(result) − last[c] ≤ k, skip it; otherwise append it and set last[c].

Constructed checks (made-up values, run in code): "abba", k = 2 → "ab"; "abcab", k = 3 → "abc"; "aaaa", k = 1 → "a". Matched the literal merge process on 3,000 random strings.

Measuring distance with the original indices: the first check → "aba" instead of "ab".

Time: O(n)  
Space: O(1) beyond the output

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
