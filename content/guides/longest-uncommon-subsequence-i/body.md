## The whole string is the best candidate

If `a == b`, every subsequence of one is a subsequence of the other, so the answer is −1.

Otherwise, take the longer string (if they have equal length, either one). It cannot be a subsequence of a string that is shorter or different with the same length. A whole string is the longest subsequence it has, so the answer is `max(len(a), len(b))`.

Longest Uncommon Subsequence II (522) has many strings, and the whole-string idea needs a subsequence check against the others.

Do not compute LCS or enumerate subsequences — this is a trick question about the whole strings.

Time: O(n) for the equality test  
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
