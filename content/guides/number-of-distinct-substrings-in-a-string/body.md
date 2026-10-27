Return the number of distinct non-empty substrings of s. For instance, "aabbaba" → 21 and "abcdefg" → 28. A follow-up typically asks for better than O(n²). _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Count new trie nodes

1. For each start `i`, walk the trie along `s[i:]`, creating nodes as needed.
2. Each created node is one new distinct substring; return the count.

Constructed check: `"aabbaba"` → 21. `"abcdefg"` → 28 (all `7 · 8 / 2` are distinct). `"aaa"` → 3.

Faster: a suffix automaton counts `Σ (len[v] − len[link[v]])` in O(n). Rolling hashes per length also work but risk collisions. Do not store every substring in a set of strings (O(n³) memory).

Time: O(n²) trie, O(n) suffix automaton  
Space: O(n²) trie, O(n) automaton

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
