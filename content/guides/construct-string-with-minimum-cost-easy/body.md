Given a target string, a list of words and a cost for each word, build the target by appending words, paying each word’s cost every time it is used. Return the minimum total cost, or −1 if the target cannot be built. This version has smaller limits than 3213; they are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Try every word

1. dp[0] = 0, the rest ∞.
2. From each reachable i, for each word w matching target at i: dp[i + |w|] = min(dp[i + |w|], dp[i] + cost).
3. Return dp[n], or −1.

Constructed checks (run in code): abcdef with abdef 100, abc 1, d 1, def 10, ef 5 → 7; aaaa with z, zz, zzz → −1; abab with ab 5, a 1, b 1 → 4.

Always taking the longest matching word: the first check → 11 instead of 7. The grouped-by-length method from 3213 works here too.

Time: O(n · total word length)  
Space: O(n)

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
