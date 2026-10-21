You are given a string s of lowercase English letters. In one operation you may change any character of s to any other character. Return true if s can be made a palindrome using exactly one or two operations, and false otherwise. For instance, abcdba → true; aa → true; abcdef → false. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## At most two bad pairs

1. `bad` = number of `i < n / 2` with `s[i] ≠ s[n − 1 − i]`.
2. Return `bad ≤ 2`.

Constructed checks (verified against trying every one- and two-character change on 300 random strings): abcdba → true, aa → true, abcdef → false, a → true.

A mismatched pair is fixed by changing one of its two characters. With fewer than two mismatches, a leftover operation can change both characters of a matching pair, or the middle character, and the string stays a palindrome.

Time: O(n)  
Space: O(1)

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
