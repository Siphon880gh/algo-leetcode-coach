You are given a string s. Find the longest substring t of s, other than s itself, such that every letter in t appears in s only inside t. Return its length, or the not-found value the statement gives. Limits are in the official statement. For instance, abba → 2 (bb), and abab has no answer. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## At most 26 starts

1. first[c], last[c] for each letter.
2. For each start st = first[c]: end = st. For j = st, st + 1, …: if first[s[j]] < st, stop; end = max(end, last[s[j]]); if end = j and the length j − st + 1 < |s|, it is a candidate.
3. Return the longest candidate, or not found.

Constructed checks (run in code): abba → 2, abab → none, abacd → 4, aaaa → none; 3,000 random strings match testing every substring.

Exclude s itself: a letter-free outside always holds for the whole string, so aaaa would give 4.

Time: O(26 n)  
Space: O(26)

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
