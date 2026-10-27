## Reverse the problem

1. `enc[keys[i]] = values[i]`.
2. Constructor: for each dictionary word that can be encrypted (all letters in keys), `cnt[encrypt(word)] += 1`.
3. `encrypt(w)`: join `enc[c]`. `decrypt(s)`: return `cnt[s]`.

Example 1 → `[null,"eizfeiam",2]`.

Two keys can share a value (a and c both map to ei), so decrypting forward branches; counting encrypted dictionary words avoids that entirely. Dictionary words with letters outside keys can never be a decryption.

Time: O(Σ |dictionary|) setup, O(|w|) per call  
Space: O(Σ |dictionary|)

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
