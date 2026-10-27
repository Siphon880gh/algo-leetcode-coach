## Only two choices

Move `l` and `r` inward while `s[l] == s[r]`. If they cross, the string is already a palindrome.

At the first mismatch, any valid deletion must remove `s[l]` or `s[r]`; the outer pairs already match. Return `isPal(l + 1, r) or isPal(l, r − 1)`, each a plain two-pointer check with no more deletions.

Do not delete greedily on one side only; `"abcb"` needs the left skip (`"bcb"`) and `"bcba"` needs the right skip (`"bcb"`). Do not recurse with a deletion budget past the first mismatch; allowing branches at every mismatch makes it exponential.

Time: O(n)  
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
