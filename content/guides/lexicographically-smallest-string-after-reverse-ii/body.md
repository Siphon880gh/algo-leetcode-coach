This is part I with a much longer string. Reverse either the first k or the last k characters of s, exactly once, for some k from 1 to n, and return the smallest string you can get. Building all 2n results is too slow here. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Hash compare

1. t = reverse(s). Prefix move k: t[n − k:] + s[k:]. Suffix move k: s[:n − k] + t[:k].
2. Precompute prefix hashes of s and t; a candidate’s prefix hash joins at most two piece hashes.
3. less(a, b): binary search the longest equal prefix, then compare the next character.
4. Scan all 2n candidates and keep the smallest.

Constructed checks (made-up strings, run in code): "cbca" → "acbc"; "bccb" → "bbcc"; "a" → "a". Checked against building every candidate on 2,000 random strings.

Trying only prefix reversals: "bccb" → "bccb" instead of "bbcc".

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
